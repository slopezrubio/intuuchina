<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class Testimonial extends Model
{
    //
    protected $fillable = ['id', 'quotes', 'occupation', 'company', 'user_id'];

    public function setQuotes() {
        if (isset($this->quotes)) {
            $this->quotes = json_decode($this->quotes);
        }

        return $this;
    }

    public static function getFromDistinctUsers(int $numberOfRows)
    {
        $testimonials = DB::table('testimonials')
                        ->join('users', 'testimonials.user_id', '=', 'users.id')
                        ->select('users.name', 'users.surnames', 'users.avatar', 'testimonials.occupation', 'testimonials.quotes', 'testimonials.company')
                        ->take($numberOfRows)
                        ->get();

        return $testimonials->map(function($testimonials) {
            $testimonials->quotes = json_decode($testimonials->quotes);
            return $testimonials;
        });
    }

    public static function getAdminList() {
        return Testimonial::all();
    }
}
