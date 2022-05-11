<?php


namespace App\Http\Requests;


use App\Rules\ValidateCPF;
use App\Rules\VerifyCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class PayRollLoanBudgetRequest extends FormRequest
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
            'price_loan'         => 'required|numeric|min:50|max:10000000',
            'has_car'            => 'required|min:1',
            'has_property'       => 'required|min:1',
            'owner_name'         => 'required|min:3|max:32',
            'owner_last_name'    => 'required|min:3|max:32',
            'owner_cpf'          => ['required' , new ValidateCPF ]  ,
            'owner_date_birth'   => 'required|min:1',
            'owner_email'        => 'required|email',
            'owner_phone_number' => 'required|min:3|max:32',
            'contact_preference' => 'required|min:1|max:32',
            'contact_time'       => 'required|min:1|max:32',
            'captcha'            => ['required', new VerifyCaptcha ]

        ];

    }
}
