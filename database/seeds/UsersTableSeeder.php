<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $admin = factory(User::class, 1)->create([
            'id' => $faker->unique()->randomDigit,
            'name' => 'Fernando',
            'surnames' => 'de Zavala Carvajal',
            'email' => 'fernando.zavala@intuuchina.com',
            'type' => 'admin',
            'cv' => null,
            'phone_number' => array(
                'prefix' => 'esp',
                'number' => '659566062',
             ),
            'status_id' => null,
            'program' => null,
            'industry' => null,
            'university' => null,
            'password' => Hash::make('***********'),
            'api_token' => Str::random(60),
        ]);

        $users = factory(User::class, 3)->create();
    }
}
