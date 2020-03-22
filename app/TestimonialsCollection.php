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

    public function __construct($items = [], $type = 'admin')
    {
        if ($type !== null) {
            $this->collection = $this->$type();
        }
    }

    public function admin() {
        return (new Collection(DB::table('testimonials')
            ->join('users', function($join) {
                $join->on('testimonials.user_id', '=', 'users.id');
            })
            ->where('users.type', 'user')
            ->select('users.name as name',
                'users.id',
                'users.surnames',
                'users.email',
                'testimonials.occupation',
                'testimonials.company',
                'users.avatar as picture',
                'users.university',
                'users.phone_number',
                'testimonials.created_at',
                'testimonials.quotes')->get()));
    }

    public function match()  {
        return $this->collection = $this->collection->filter(function($value, $key) {
            return Str::is('*'.request()->query('search').'*', $value->name) || Str::is('*'.request()->query('search').'*', $value->surnames);
        });
    }
}