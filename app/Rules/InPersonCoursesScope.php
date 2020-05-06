<?php

namespace App\Rules;

use App\Fee;
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
        return $value >= intval(Fee::where('value', 'chinese_in-person_course')->first()->minimum);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $course = Fee::where('value', 'chinese_in-person_course')->first();

        return trans_choice('validation.custom.minimum', $course->minimum ,[
            'value' => $course->minimum,
            'unit' => $course->unit
        ]);
    }
}
