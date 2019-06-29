<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\OffersController;
use App\Offer;

class OffersConstrollerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAllOffersComeWithTheRemainingDaysToBeRenewed() {
        $offers = Offer::all();
        $offersController = new OffersController();
        $offersController->setDaysRenewed($offers);
    }
}
