<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\UserCustomer;
use App\Classes\Helper\SetCharacter;

class VerifyEmailExists implements Rule
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
        $user = UserCustomer::where('email' , SetCharacter::makeLowercase($value))->first();
        if($user){
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
        return 'Este e-mail já possui em nosso cadastro , entre em contato com o suporte .';
    }
}
