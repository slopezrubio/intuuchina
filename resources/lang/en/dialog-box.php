<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Titles
    |--------------------------------------------------------------------------
    */

    'thanks you for applying' => 'Thank you for applying',
    'confirmation receipt' => 'Confirmation Receipt',
    'payment details' => 'Payment Details',


    /*
    |--------------------------------------------------------------------------
    | Bodies
    |--------------------------------------------------------------------------
    */

    'the payment process has been carried out' => '<p>The payment process has been carried out successfully. You should have received in your inbox a confirmation receipt of the recent payment. If that weren\'t the case, we steadfastly suggest you to contact us as soon as possible at <a href="mailto:hr@intuuchina.com">hr@intuuchina.com</a></p>',
    'one of our colleagues' => '<p>One of our colleagues will send you an e-mail in the next few minutes. If you don\'t get the e-mail, please contact us promptly at <a href="mailto:hr@intuuchina.com">hr@intuuchina.com</a></p><p>Can you please confirm once you have received an email?</p>',
    'you should have received an email' => '<p>You should have received an email from one of our colleagues.</p><p>Please check your email inbox and confirm. Conversely, if you don\'t, please contact us as soon as possible at <a href="mailto:hr@intuuchina.com">hr@intuuchina.com</a></p>',
    'we get 500 people' => '<p>We get 500 people per month asking for our services and in order to ensure we only proceed with those that are really committed we request an application fee of ' . numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), 30, Config::get('services.stripe.cashier_currency')) . ' </p><p>Continue to proceed with the payment.</p>',

];