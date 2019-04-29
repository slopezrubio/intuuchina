<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = ['title', 'location', 'job_type', 'education', 'duration', 'description', 'preferred_skills', 'non_technical_skills'];
    
        
    public function insert() {

    }


}
