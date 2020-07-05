<?php

namespace App\Rules;

use App\Fee;
use Illuminate\Contracts\Validation\Rule;

class InPersonCoursesScope implements Rule
{
    protected $fee;

    /**
     * Create a new rule instance.
     *
     * @param Fee $fee
     */
    public function __construct(Fee $fee)
    {
        $this->fee = $fee;
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
        return $value >= intval($this->fee->minimum);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans_choice('validation.custom.minimum', $this->fee->minimum ,[
            'value' => $this->fee->minimum,
            'unit' => $this->fee->unit
        ]);
    }
}
