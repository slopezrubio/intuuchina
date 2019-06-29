<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    //

    protected $fillable = ['title', 'location', 'industry', 'duration', 'description', 'preferred_skills'];

    public function setDaysRenewed() {

    }

}
