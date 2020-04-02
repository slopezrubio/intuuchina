<?php

use App\Traits\Archivable;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    use Archivable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = $this->loadDataFromFile('offers');

        foreach ($offers as $offer) {
            App\Offer::create($offer);
        }

       //$offers = factory(App\Offer::class,5)->create();
    }
}
