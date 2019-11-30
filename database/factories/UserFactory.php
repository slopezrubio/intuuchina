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
    return [
        'name' => $faker->name,
        'surnames' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'nationality' => 'chinese',
        'email_verified_at' => now(),
        'type' => 'user',
        'phone_number' => json_encode([
            'prefix' => $faker->randomElement(array('fr', 'es', 'slo', 'pr', 'de', 'uk')),
            'number' => substr($faker->e164PhoneNumber, strlen($faker->e164PhoneNumber) - 9),
        ]),
        'status_id' => function() {
            return DB::table('states')
                ->select(DB::raw('id'))
                ->where('name', 'pending_confirmation')
                ->get()->first()->id;
        },
        'program' => $faker->randomElement(array('inter_relocat', 'internship')),
        'industry' => $faker->randomElement(array('finance', 'design', 'it')),
        'university' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
