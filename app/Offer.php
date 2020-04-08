<?php

namespace App;

use App\Traits\Archivable;
use Carbon\Carbon;
use DBlackborough\Quill\Render as QuillRender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{

    const THUMBNAILS_FOLDER = 'thumbnails/';

    protected $fillable = ['created_at', 'updated_at','title', 'location', 'industry', 'duration', 'description', 'picture'];

    public function getRenderedDescription() {
        $quill = new QuillRender($this->description, 'HTML');
        return $quill->render();
    }

    public function hasDescription() {
        return strlen($this->description) > 0 && strlen(trim($this->description)) && $this->description !== null;
    }

    public static function getAdminList() {
        return Offer::all();
    }

    public function destroyThumbnail() {
        if (!preg_match('/generic/', $this->picture)) {
            Storage::delete('public/images/thumbnails/' . $this->id . '/' .  $this->picture);
        }
    }

    public function saveThumbnail() {
        $filename = $this->generateThumbnailFileName();;

        if (request()->file('picture') !== null) {
            $this->removeThumbnail();
            request()->file('picture')->storeAs('public/images/thumbnails/', $filename);
        }

        $this->picture = self::THUMBNAILS_FOLDER . $filename;

        return $this;
    }

    public function removeThumbnail() {
        if (Storage::exists('public/images/' . $this->picture)) {
            Storage::delete('public/images/' . $this->picture);
            return $this;
        }

        return false;
    }

    public function updateThumbnail($picture) {
        $this->destroyThumbnail();
        $this->saveThumbnail($picture);
    }

    public function setChanges(Request $request) {
        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') {
                if ($key === 'picture') {
                    $this->updateThumbnail($request->file($key));
                } else {
                    if ($this[$key] != $request->get($key)) {
                        $this[$key] = $request->get($key);
                    }
                }
            }
        };

        return $this;
    }

    public function generateThumbnailFileName() {
        if (method_exists(request(), 'get') && request()->file('picture')) {
            if (request()->get('location') && request()->get('industry')) {
                return $this->id . '/' . request()->get('location') . '_' . request()->get('industry') . '_' . Carbon::now()->micro . '.' . request()->file('picture')->getClientOriginalExtension();
            }
        }

        return 'default/generic_' . $this->industry . '_picture_'. Arr::random([1,2,3]) . '.jpg';
    }
}
