<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = factory(App\User::class, 1)->create([
            'name' => 'Confucio',
            'surnames' => 'Shandong',
            'email' => 'confucio@confucio.es',
            'type' => 'admin',
            'status_id' => function() {
                return DB::table('states')
                    ->select(DB::raw('id'))
                    ->where('name', 'unaltered')
                    ->get()->first()->id;
            },
            'program' => null,
            'industry' => null,
            'university' => null,
            'password' => '**********',
        ]);

        $users = factory(App\User::class, 3)->create();
    }
}
