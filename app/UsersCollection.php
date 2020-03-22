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
    const ELEMENTS_PER_PAGE = 2;

    protected $collection;

    public function __construct($items = [], $type = 'admin')
    {
        if ($type !== null) {
            $this->collection = $this->$type();
        }
    }

    public function admin() {
        $collection = (new Collection(DB::table('users')
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
        $this->setCompletePhoneNumber($collection);

        return $collection;
    }

    public function setCompletePhoneNumber($collection) {
        $collection->each(function($item, $key) {
            $item->phone_number = '(' . __('prefixes.' . json_decode($item->phone_number)->prefix . '.prefix') . ')'. json_decode($item->phone_number)->number;
        });

        return $this;
    }

    public function match() {
        $this->collection = $this->collection->filter(function($value, $key) {
            return Str::is('*'.strtoupper(request()->query('search')).'*', strtoupper($value->name)) || Str::is('*'.strtoupper(request()->query('search')).'*', strtoupper($value->surnames));
        });
    }
}