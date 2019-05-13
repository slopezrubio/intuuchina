<?php

use Illuminate\Database\Seeder;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $offers = factory(App\Offer::class,4)->create();
    }
}
