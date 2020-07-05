<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    //

    public function fees() {
        return $this->hasMany('App\Fee', 'type');
    }

    public function programs() {
        return $this->hasMany('App\Program', 'fee_type_id');
    }

    public static function getOptions() {
        $options = [];
        $feeTypes = self::all();

        foreach($feeTypes as $feeType) {
            $options[$feeType->value] = $feeType->name;
        }

        return $options;
    }
}
