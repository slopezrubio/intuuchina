<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //

    public function programs() {
        return $this->belongsToMany('App\Program');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function feeType() {
        return $this->belongsTo('App\FeeType', 'type');
    }

    public function getTaxRate() {
        return __('taxes.'.$this->jurisdiction);
    }
}
