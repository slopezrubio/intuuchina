<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ['unverified', 'verified', 'paid', 'arranged', 'accepted', 'dismissed', 'reimbursed', 'placed', 'done', 'unaltered'];

        foreach ($states as $state) {
            factory(App\Status::class, 1)->create([
                'value' => $state,
            ]);
        }
    }
}