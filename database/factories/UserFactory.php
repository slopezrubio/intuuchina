<?php

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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
        'name' => $faker->lastName,
        'surnames' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nationality' => 'chinese',
        'email_verified_at' => now(),
        'type' => 'user',
        'cv' => Storage::putFile('cv', new File(public_path('storage/images/test_files/fake_cv.docx'))),
        'phone_number' => json_encode([
            'prefix' => 'fra',
            'number' => substr($faker->e164PhoneNumber, strlen($faker->e164PhoneNumber) - 9),
        ]),
        'status_id' => function() {
            return DB::table('states')
                ->select(DB::raw('id'))
                ->where('name', 'unverified')
                ->get()->first()->id;
        },
        'program' => $faker->randomElement(array('internship', 'inter_relocat')),
        'industry' =>  $faker->randomElement(array_keys(__('content.industries'))),
        'university' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
    ];
});
