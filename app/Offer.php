<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    //

    protected $fillable = ['created_at', 'updated_at','title', 'location', 'industry', 'duration', 'description', 'picture'];

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
