<?php


namespace App;

use App\Helpers\Money;
use App\Interfaces\Searchable;
use App\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeesCollection extends Collection implements Searchable
{
    protected $collection;

    public function __construct($items = [], $type = 'admin')
    {
        if ($type !== null) {
            $this->$type();
        }

        return $this;
    }

    public function admin() {
        $this->collection = (new Collection(DB::table('fees')
            ->join('fee_types', function($join) {
                $join->on('fees.type', '=', 'fee_types.id');
            })
            ->select('fees.id',
                'fees.heading as title',
                'fees.amount',
                'fee_types.name as fee_type')
            ->get()))
        ->each(function($item) {
            $item->amount = Money::currencyFormat($item->amount);
            $item->tax = __('taxes.'.Fee::find($item->id)->jurisdiction.'.display_name');
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
            return Str::contains(strtolower($value->title), $this->getSearchKeys()) || Str::contains(strtolower($value->fee_type), $this->getSearchKeys());
        });

        return $this;
    }
}