<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use \ReCaptcha\ReCaptcha;

class Captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            $this->error_msg = __('validation.required', 'Captcha');
            return false;
        }

        $recaptcha = new ReCaptcha(config('recaptcha.secret_key'));

        $response = $recaptcha->setExpectedHostName($_SERVER['SERVER_NAME'])
            ->setScoreThreshold(0.5)
            ->verify($value, $_SERVER['REMOTE_ADDR']);

        if (!$response->isSuccess()) {
            $this->error_msg = __('validation.custom.captcha.failed');

            return false;
        }

        if ($response->getScore() < 0.5) {
            $this->error_msg = __('validation.custom.captcha.failed');

            return false;
        }

        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mark that you are not a robot, please.';
    }
}
