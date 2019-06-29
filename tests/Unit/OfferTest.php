<?php

namespace Tests\Unit;

use Carbon\CarbonImmutable;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\OffersController;
use App\Offer;
use Carbon\Carbon;

/**
 * Class OfferTest
 * @package Tests\Unit
 */
class OfferTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Checks if the offers obtained from the database have come
     * with a build in property called gone_by.
     */
    public function testAllOffersComeWithTheRemainingDaysToBeRenewed() {
        $offers = Offer::all();
        $offer = new Offer();
        $offers = $offer->setDaysRenewed($offers);
        $offersWithTheRemainingDays = 0;
        foreach ($offers as $offer) {
            if (isset($offer->gone_by)) {
                $offersWithTheRemainingDays++;
            };
        }

        $this->assertTrue($offersWithTheRemainingDays === Offer::all()->count());
    }

    /**
     * Register a new single offer into the database.
     */
    public function createSingleOffer() {
        $offer = Offer::create([
            'title' => $this->faker->sentence,
            'location' => $this->faker->randomElement(array('shanghai', 'beijing', 'hongkong')),
            'industry' => $this->faker->randomElement(array('finance', 'design', 'consultant', 'educaton', 'it', 'legal')),
            'duration' => $this->faker->randomElement(array(1,2,3,4,5,6,7,8,9,10,11,12)),
            'description' => $this->faker->text(190),
            'preferred_skills' => $this->faker->text(190),
            'picture' => $this->faker->regexify('storage/images/generic_finance_picture' . $this->faker->randomElement(array(1,2,3)) . '\.jpg'),
        ]);

        return $offer;
    }

    /**
     * Check if the current date is added implicitly in the 'created_at'
     * field when the offer is stored.
     *
     * @test
     */
    public function testCreatedOfferSetsCurrentDate()
    {
        $offer = $this->createSingleOffer();
        $date = $offer->created_at->format('Y-m-d');
        $currentDate = CarbonImmutable::now()->format('Y-m-d');
        $this->assertEquals($date, $currentDate);
    }
}
