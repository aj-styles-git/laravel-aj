<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\students\Student;
 
class ValidStudent implements Rule
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
        //

        try {

            $student = Student::find($value);

            if (!$student) {
                return false;
            }

            return $student->status !== 0;
        } catch (\Exception $e) {
            DB::rollBack();
            $res['message'] = $e->getMessage();
            $res['code'] = 500;
            saveAppLog($res['message']);
            return $res;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are blocked.';
    }
}
