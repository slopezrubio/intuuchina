<?php

use Faker\Generator as Faker;
use App\Testimonial;
use Illuminate\Support\Facades\DB;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        //
        'quotes' => json_encode([
            'es' => '',
            'en' => $faker->sentence,
        ]),
        'occupation' => $faker->jobTitle,
        'company' => $faker->company,
        'user_id' => function() {
            return DB::table('users')
                ->select(DB::raw('id'))
                ->get()->first()->id;
        },
    ];
});
