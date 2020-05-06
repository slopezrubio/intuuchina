<?php


namespace App;

use App\User;
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
            ->join('statuses', function($join) {
                $join->on('users.status_id', '=', 'statuses.id');
            })
            ->join('programs', function($join) {
                $join->on('users.program_id', '=', 'programs.id');
            })
            ->where('users.type', 'user')
            ->select('users.name as name',
                'users.id',
                'users.surnames',
                'users.email',
                'programs.name as subtext',
                'users.avatar as picture',
                'users.phone_number',
                'users.stripe_id as stripe',
                'users.created_at',
                'statuses.value as status')
            ->orderBy('id', 'ASC')->get()
            ->each(function($item, $key) {
                $item->categories = User::find($item->id)->categories;
                $item->phone_number = User::e164NumberFormat((array) json_decode($item->phone_number));
            })));

        return $this;
    }

    public function getSearchKeys() {
        return explode(' ', strtolower(request()->query('search')));
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