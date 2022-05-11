<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\UserPub;


class VerifyPassword implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */


    public function __construct($password)
    {
        $this->password  = $password;
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

       if (! Hash::check($value, $this->password)) {
            return false;
        }


        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A senha antiga não confere .';
    }
}
