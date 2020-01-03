<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InPersonCoursesScope implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return $value >= intval(__('content.courses.in-person.scope.min'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $minimumStaying = __('content.courses.in-person.scope.min');

        return trans_choice('validation.custom.minimum_staying', $minimumStaying, ['value' => $minimumStaying]);
    }
}
