<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\institutes\Institute;

class ValidInstitute implements Rule
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
        $institute = Institute::find($value);

        if (!$institute) {
            return false;
        }

        return !in_array($institute->status, [0, 2,3]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Institute is either blocked or pending or rejected.';
    }
}
