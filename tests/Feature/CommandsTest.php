<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Offer;
use Carbon\Carbon;

class CommandsTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Register a new single offer into the database with the 'created_at' virtually created between
     * one year and three months from the current date.
     */
    public function createSingleOfferWithExpiredDate() {
        $offer = Offer::create([
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-3 months'),
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
     * Check if the command 'php artisan offer:renew' does update all the offers that
     * overcome two months since they have been modified.
     *
     * @test
     */
    public function testOfferDateIsUpdatedAfterTwoMonths()
    {
        $this->createSingleOfferWithExpiredDate();
        exec('php artisan offer:renew');
        $expirationDate = Carbon::now();
        $expirationDate->month -= 2;
        $this->assertNotTrue(Offer::where('created_at','<',$expirationDate)->count() > 0);
    }


}
