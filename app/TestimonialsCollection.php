<?php


namespace App;

use App\Interfaces\Searchable;
use App\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestimonialsCollection extends Collection implements Searchable
{
    protected $collection;
    protected $name;

    public function __construct($items = [], $type = 'admin')
    {
        if ($type !== null) {
            $this->$type();
        }

        return $this;
    }

    public function admin() {
        $this->collection = (new Collection(DB::table('testimonials')
            ->join('users', function($join) {
                $join->on('testimonials.user_id', '=', 'users.id');
            })
            ->where('users.type', 'user')
            ->select('users.name as name',
                'users.id',
                'users.surnames',
                'users.email',
                'testimonials.occupation',
                'testimonials.company as place',
                'users.avatar as picture',
                'users.phone_number',
                'testimonials.created_at',
                'testimonials.quotes')
            ->get()));

        return $this;
    }

    public function hasSearchKeys() {
        return request()->query('search') !== null;
    }

    public function getSearchKeys() {
        return explode(' ', strtolower(request()->query('search')));
    }

    public function match()  {
        $this->collection = $this->collection->filter(function($value, $key) {
            return Str::contains(strtolower($value->name), $this->getSearchKeys()) || Str::contains(strtolower($value->surnames), $this->getSearchKeys());
        });

        return $this;
    }
}