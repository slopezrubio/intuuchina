<?php


namespace App\Helpers;


use Illuminate\Support\Facades\App;
use NumberFormatter;

class Tax extends Helper
{
    public static function getOptions() {
        $options = [];

        foreach (__('taxes') as $key => $tax) {
            $options[$key] = $tax['display_name'].' / '.$tax['description'].' / '.self::percentage($tax);
        }

        return $options;
    }

    /**
     * Get the corresponding tax percentage belonging to the given tax.
     *
     * @param array $tax
     * @return false|string
     */
    public static function percentage(array $tax) {
        return number_format(floatval($tax['percentage']), 2, '.', ',').'%';
    }
}