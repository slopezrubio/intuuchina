<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $admin = factory(App\User::class, 1)->create([
            'name' => 'Confucio',
            'surnames' => 'Shandong',
            'email' => 'confucio@confucio.es',
            'type' => 'admin',
            'phone_number' => json_encode([
                'prefix' => 'ch',
                'number' => substr($faker->e164PhoneNumber, strlen($faker->e164PhoneNumber) - 9),
            ]),
            'status_id' => function() {
                return DB::table('states')
                    ->select(DB::raw('id'))
                    ->where('name', 'unaltered')
                    ->get()->first()->id;
            },
            'program' => null,
            'industry' => null,
            'university' => null,
            'password' => hash('**********'),
        ]);

        $users = factory(App\User::class, 3)->create();
    }
}
