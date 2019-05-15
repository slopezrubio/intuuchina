<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    //

    protected $fillable = ['title', 'location', 'industry', 'education', 'duration', 'description', 'preferred_skills', 'non_technical_skills'];

}
