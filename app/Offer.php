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
            ->select('offers.id', 'category_id', 'categories.name as category', 'picture as thumbnail', 'title', 'location as subtitle', 'duration as time', 'offers.created_at', 'offers.updated_at')
            ->join('categories', 'offers.category_id', '=','categories.id')
            ->orderBy('updated_at', 'desc');

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
        if (!$this->hasDefaultThumbnail()) {
            if (Storage::exists('public/images/thumbnails/' . $this->id . '/' .  $this->picture)) {
                Storage::delete('public/images/thumbnails/' . $this->id . '/' .  $this->picture);
            }
        }
    }

    public static function deleteAllThumbnails() {
        $directories = Storage::directories('public/images/thumbnails');
        foreach ($directories as $directory) {
            if ($directory !== 'public/images/' . self::THUMBNAILS_FOLDER . 'default') {
                Storage::deleteDirectory($directory);
            }
        }
    }

    public function hasDefaultThumbnail() {
        return preg_match('/generic/', $this->picture);
    }

    public function existUploadedThumnbnail() {
        return count(Storage::files('public/images/' . self::THUMBNAILS_FOLDER . $this->id)) > 0;
    }

    public function saveThumbnail(array $attributes = []) {
        $filename = isset($attributes['category'])
            ? $this->generateThumbnailFileName(Category::find($attributes['category'])->value)
            : $this->generateThumbnailFileName();

        if (request()->file('picture') !== null) {
            $this->destroyThumbnail();
            request()->file('picture')->storeAs('public/images/thumbnails/', $filename);
        }

        if ($filename !== null) {
            return self::THUMBNAILS_FOLDER . $filename;
        }

        return $filename;
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

    public function generateThumbnailFileName(string $category = null) {
        if (method_exists(request(), 'get')) {
            if (request()->file('picture')) {
                if (request()->get('location') && request()->get('industry')) {
                    return $this->id . '/' . request()->get('location') . '_' . request()->get('industry') . '_' . Carbon::now()->micro . '.' . request()->file('picture')->getClientOriginalExtension();
                }
            }

            if (!$this->existUploadedThumnbnail()) {
                return self::getDefaultThumbnailFileName($category !== null ? $category : request()->get('industry'));
            }
        }

        if (!$this->existUploadedThumnbnail()) {
            return self::getDefaultThumbnailFileName($this->category->value);
        }

        return null;
    }

    public static function getDefaultThumbnailFileName($category) {
        return 'default/generic_' . $category . '_picture_' . Arr::random([1,2,3]) . '.jpg';
    }
}
