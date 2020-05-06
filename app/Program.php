<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //

    public function feeType() {
        return $this->belongsTo('App\FeeType');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public static function getByValue($value) {
        $program = self::where('value', $value);

        if ($program !== null) {
            return $program->first();
        }

        return null;
    }

    public static function getOptions() {
        $options = [];
        $programs = self::all();

        foreach($programs as $program) {
            $options[$program->value] = $program->name;
        }

        return $options;
    }
}
