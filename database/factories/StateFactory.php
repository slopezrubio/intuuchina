<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        //
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
