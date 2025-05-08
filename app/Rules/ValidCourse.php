<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\courses\Course;
 
class ValidCourse implements Rule
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
        $course = Course::find($value);

        if (!$course) {
            return false;
        }

        return !in_array($course->status, [0, 2,3]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Couse is not approved or blocked or rejected by admin contact support.';
    }
}
