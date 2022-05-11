<?php

namespace App\Rules;

use App\Classes\Helper\SetCharacter;
use App\Models\UserAdmin;
use Illuminate\Contracts\Validation\Rule;

class ValidateEmailExist implements Rule
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
        $user = UserAdmin::where('email' , SetCharacter::makeLowercase($value))->first();
        if($user){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este e-mail não possui em nosso cadastro , entre em contato com o suporte .';
    }
}
