<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Classes\Captcha\MessageCaptcha;
use Session;

class VerifyCaptcha implements Rule
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

        if($value == Session::get('captcha')['value']){
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
        return 'Digite o Código Corretamente .';
    }
}
