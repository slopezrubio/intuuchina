<?php


namespace App;

use App\Interfaces\Searchable;
use App\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersCollection extends Collection implements Searchable
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
        $this->collection = (new Collection(DB::table('users')
            ->join('states', function($join) {
                $join->on('users.status_id', '=', 'states.id');
            })
            ->where('users.type', 'user')
            ->select('users.name as name',
                'users.id',
                'users.surnames',
                'users.email',
                'users.program as subtext',
                'users.industry as internship',
                'users.study',
                'users.avatar as picture',
                'users.university',
                'users.phone_number',
                'users.stripe_id as stripe',
                'users.created_at',
                'states.name as status')->get()));
        $this->setCompletePhoneNumber();

        return $this;
    }

    public function getSearchKeys() {
        return explode(' ', strtolower(request()->query('search')));
    }

    public function setCompletePhoneNumber() {
        $this->collection->each(function($item, $key) {
            $item->phone_number = '(' . __('prefixes.' . json_decode($item->phone_number)->prefix . '.prefix') . ')'. json_decode($item->phone_number)->number;
        });

        return $this;
    }

    public function hasSearchKeys() {
        return request()->query('search') !== null;
    }

    public function match() {
        $this->collection = $this->collection->filter(function($value, $key) {
            return Str::contains(strtolower($value->name), $this->getSearchKeys()) || Str::contains(strtolower($value->surnames), $this->getSearchKeys());
        });

        return $this;
    }
}