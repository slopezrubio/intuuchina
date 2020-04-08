<?php


namespace App;

use App\Interfaces\Searchable;
use App\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OffersCollection extends Collection implements Searchable
{
    const SHORT_DESCRIPTION_LENGTH = 24;

    protected $collection;

    public function __construct($items = [], $type = 'admin')
    {
        if ($type !== null) {
            $currentPage = 1;

            $this->$type();
        }

        return $this;
    }

    public function admin() {
        $this->collection = (new Collection(DB::table('offers')
            ->select('offers.id',
                'offers.title',
                'offers.location',
                'offers.description',
                'offers.duration',
                'offers.picture',
                'offers.created_at')->get()));
        $this->setShortDescription();

        return $this;
    }

    public function setShortDescription() {
        $this->collection->each(function($item) {
            if (preg_match('/\w/', $item->description) && $item->description !== null) {
                $item->description = Str::words(json_decode($item->description)->ops[0]->insert, self::SHORT_DESCRIPTION_LENGTH);
            }
        });

        return $this;
    }

    public function hasSearchKeys() {
        return request()->query('search') !== null;
    }

    public function getSearchKeys() {
        return explode(' ', strtolower(request()->query('search')));
    }

    public function match() {

        $this->collection = $this->collection->filter(function($value, $key) {
            return Str::contains(strtolower($value->title), $this->getSearchKeys()) || Str::contains(strtolower($value->location), $this->getSearchKeys());
        });

        return $this;
    }
}