<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    //

    protected $fillable = ['created_at', 'updated_at','title', 'location', 'industry', 'duration', 'description', 'picture'];

    /**
     * Sets a new field for each offer the time consummated since the offer was
     * updated for the last time. This information will be shown in the view
     * as the date of the offer.
     *
     * @param $offers
     * @return mixed
     */
    public function setDaysRenewed($offers) {
        foreach ($offers as $offer) {
            $offer->gone_by = $this->getDiffForHumans($offer->created_at);
        }

        return $offers;
    }

    /*
 * Get the difference between the creation Date of an offer and the current time
 *
 * @param string $date
 * @return string
 */
    public function getDiffForHumans($date) {
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }

    /**
     * Sets the last updated with the current time.
     *
     * @param boolean $updated
     */
    public function renewUpdateAt($updated) {
        if ($updated) {
            $this['updated_at'] = Carbon::now();
        }
    }
}
