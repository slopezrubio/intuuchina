<?php


namespace App\Helpers;

use Illuminate\Support\Facades\App;
use NumberFormatter;

class Money extends Helper
{
    public static function currencyFormat($value, $currency = null) {
        if ($currency === null) {
           $currency = config('services.stripe.cashier_currency');
        }

        return numfmt_format_currency(numfmt_create(App::getLocale(), NumberFormatter::CURRENCY), $value, $currency);
    }
}