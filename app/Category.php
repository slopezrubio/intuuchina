<?php

namespace App;

use App\Program;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //

    public static function ids($column, $values = []) {
        return self::whereIn($column, $values)->get('id');
    }

    public function programs() {
        return $this->belongsToMany('App\Program');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function fee() {
        return $this->belongsTo('App\Fee');
    }

    public static function getFilter($program) {
        $filter = Category::getSelectorOptions(Program::where('value', $program)->first()->categories);
        $filter['default'] = __('inputs.filter.'.$program.'.default');

        return $filter;
    }

    public static function getOptionsFrom($className, $value) {
        $categories = null;
        $instance = new $className;

        switch ($className) {
            case 'App\User':
                $categories = $instance::find($value)->categories;
                break;
            case 'App\Program':
                $categories = $instance::where('value', $value)->first()->categories;
                break;
        }

        return self::getOptions($categories);
    }

    public static function getOptions($categories) {
        $options = [];

        foreach ($categories as $category) {
            array_push($options, $option = [
                'id' => $category->value,
                'value' => $category->id,
                'name' => $category->name
            ]);
        }

        return $options;
    }

    public static function getSelectorOptions($categories) {
        $options = [];

        foreach($categories as $category) {
            $options[$category->value] = $category->name;
        }

        return $options;
    }
}
