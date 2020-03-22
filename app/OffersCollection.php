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
            $this->collection = $this->$type();
        }
    }

    public function admin() {
        $collection = (new Collection(DB::table('offers')
            ->select('offers.id',
                'offers.title',
                'offers.location',
                'offers.description',
                'offers.duration',
                'offers.picture',
                'offers.created_at')->get()));
        $this->setShortDescription($collection);

        return $collection;
    }

    public function setShortDescription($collection) {
        $collection->each(function($item, $key) {
            $item->description = Str::words(json_decode($item->description)->ops[0]->insert, self::SHORT_DESCRIPTION_LENGTH);
        });

        return $this;
    }

    public function match() {
        $this->collection = $this->collection->filter(function($value, $key) {
            return Str::is('*'.strtoupper(request()->query('search')).'*', strtoupper($value->title)) || Str::is('*'.strtoupper(request()->query('search')).'*', strtoupper($value->location));
        });
    }
}