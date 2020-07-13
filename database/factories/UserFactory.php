<?php

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $state = $faker->randomElement(array('verified', 'paid'));

    return [
        'name' => $faker->lastName,
        'surnames' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nationality' => 'chinese',
        'email_verified_at' => now(),
        'type' => 'user',
        'phone_number' => array(
            'prefix' => 'fra',
            'number' => substr($faker->e164PhoneNumber, strlen($faker->e164PhoneNumber) - 9),
        ),
        'status_id' => function() {
            return DB::table('statuses')
                ->select(DB::raw('id'))
                ->where('value', 'verified')
                ->orWhere('value', 'paid')
                ->inRandomOrder()
                ->get()->first()->id;
        },
        'program_id' => $faker->randomElement(DB::table('programs')->inRandomOrder()->get('id')->toArray())->id,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
    ];
});
