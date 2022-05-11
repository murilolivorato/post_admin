<?php


namespace App\Http\Requests;


use App\Rules\VerifyCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class RegisterTwoProcess extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'              => 'required|email',
            'captcha'            => ['required', new VerifyCaptcha ]
        ];

    }
}
