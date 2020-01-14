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

    'the payment process has been carried out' => '<p>The payment process has been carried out successfully. You should have received in your inbox a confirmation receipt of the recent payment. If that weren\'t the case, we steadfastly suggest you to contact us as soon as possible at <a href="mailto:info@intuuchina.com">info@intuuchina.com</a></p>',
    'one of our colleagues' => '<p>One of our colleagues will send you an e-mail in the next few minutes. If you don\'t get the e-mail, please contact us promptly at <a href="mailto:info@intuuchina.com">info@intuuchina.com</a></p>',
    'the verification process is done' =>   "
                                                <p>
                                                    The verification process is done. We just want to thank you for applying and your trust in our services.
                                                    <p>As soon as we receive the corresponding payment for your :program Program we will contact you to arrange our first meeting.</p>
                                                </p>
                                                <p>
                                                    Proceed with the payment?
                                                </p>
                                            ",
    'proceed with the payment' => '<p>Proceed with the payment?</p>',

    /*
    |--------------------------------------------------------------------------
    | Footers
    |--------------------------------------------------------------------------
    */
     'are you in doubt?' => "Are you in doubt? Contact us at <a href='mailto:" .config('mail.to.address'). "'>" .config('mail.from.address'). "</a>",

];
