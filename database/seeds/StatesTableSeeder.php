<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $states = factory(App\State::class, 1)->create([
            'name' => 'pending_confirmation',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'confirmed',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'paid',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'accepted',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'pending_deposit',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'done',
        ]);

        $states = factory(App\State::class, 1)->create([
            'name' => 'unaltered',
        ]);
    }
}