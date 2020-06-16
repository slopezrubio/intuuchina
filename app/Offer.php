<?php

namespace App;

use App\Traits\Archivable;
use Carbon\Carbon;
use DBlackborough\Quill\Render as QuillRender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{

    const THUMBNAILS_FOLDER = 'thumbnails/';

    protected $fillable = ['created_at', 'updated_at','title', 'location', 'category_id', 'duration', 'description', 'picture'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getRenderedDescription() {
        $quill = new QuillRender($this->description, 'HTML');
        return $quill->render();
    }

    public function hasDescription() {
        return strlen($this->description) > 0 && strlen(trim($this->description)) && $this->description !== null;
    }

    /**
     * Gets all the job offers formatted to be embedded into a card component matching
     * the given category and paginated according to the number of pages passed as a second
     * argument.
     *
     * @param null $category
     * @param null $num_pages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getCardList($category = null, $num_pages = null) {
        $cardList = DB::table('offers')
            ->select('offers.id', 'category_id', 'categories.name as category', 'picture as thumbnail', 'title', 'location as subtitle', 'duration as time', 'offers.created_at')
            ->join('categories', 'offers.category_id', '=','categories.id');

        if ($category !== null) {
            $cardList->where('category_id', Category::where('value', $category)->first()->id);
        }

        if ($num_pages !== null) {
            return $cardList->paginate($num_pages);
        }

        return $cardList->paginate();
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

        return self::THUMBNAILS_FOLDER . $filename;
    }

    public function removeThumbnail() {
        if (Storage::exists('public/images/' . $this->picture)) {
            Storage::delete('public/images/' . $this->picture);
            return $this;
        }

        return false;
    }

    public function updateThumbnail() {
        $this->destroyThumbnail();
        return $this->saveThumbnail();
    }

    /**
     * Update the user with the given attributes and options. Overwrites the ones provided by
     * the application in @see Illuminate\Database\Eloquent\Model class.
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        return $this->fill($attributes)->save($options);
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

        return self::getDefaultThumbnailFileName($this->category->value);
    }

    public static function getDefaultThumbnailFileName(string $category) {
        return 'default/generic_' . $category . '_picture_' . Arr::random([1,2,3]) . '.jpg';
    }
}
