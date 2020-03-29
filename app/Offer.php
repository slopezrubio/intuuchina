<?php

namespace App;

use Carbon\Carbon;
use DBlackborough\Quill\Render as QuillRender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    protected $fillable = ['created_at', 'updated_at','title', 'location', 'industry', 'duration', 'description', 'picture'];

    public function getRenderedDescription() {
        $quill = new QuillRender($this->description, 'HTML');

        return $quill->render();
    }

    public static function getAdminList() {
        return Offer::all();
    }

    public function destroyThumbnail() {
        if (!preg_match('/generic/', $this->picture)) {
            Storage::delete('public/images/thumbnails/' . $this->id . '/' .  $this->picture);
        }
    }

    public function saveThumbnail($picture) {
        $filename = 'generic_' . request()->get('industry') . '_picture.jpg';

        if (request()->file('picture') !== null) {
            $filename = $this->generateThumbnailFileName();
            $picture->storeAs('public/images/thumbnails/' . $this->id, $filename);
        }

        $this->picture = 'thumbnails/' . $this->id . '/'. $filename;
    }

    public function updateThumbnail($picture) {
        $this->destroyThumbnail();
        $this->saveThumbnail($picture);
    }

    public static function generateThumbnailFileName() {
        if (method_exists(request(), 'get')) {
            return request()->get('location') . '_' . request()->get('industry') . '_' . Carbon::now()->micro . '.' . request()->file('picture')->getClientOriginalExtension();
        }
    }
}
