<?php


namespace App\Http\Requests;


use App\Rules\ValidateCPF;
use App\Rules\VerifyCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class ConsortiumBudgetRequest extends FormRequest
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
            'type_id'            => 'required|min:1' ,
            'price_consortium'   => 'required|numeric|min:2|max:10000000',
            'price_quota'        => 'required|numeric|min:2|max:100000',
            'owner_name'         => 'required|min:3|max:32',
            'owner_last_name'    => 'required|min:3|max:32',
            'owner_cpf'          => ['required' , new ValidateCPF ]   ,
            'owner_date_birth'   => 'required|min:1',
            'owner_email'        => 'required|email',
            'owner_phone_number' => 'required|min:3|max:32',
            'contact_preference' => 'required|min:1|max:32',
            'contact_time'       => 'required|min:1|max:32',
            'captcha'            => [ 'required', new VerifyCaptcha ]

        ];

    }
}
