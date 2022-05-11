<?php


namespace App\Http\Requests;


use App\Rules\ValidateCPF;
use App\Rules\VerifyCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'branch_id' => 'required|min:1',
            'name'      => 'required|min:3|max:32',
            'email'     => 'required|email',
            'subject'   => 'required|min:3|max:32',
            'phone'     => 'required|min:8|max:16',
            'message'   => 'required|min:1|max:200',
            'captcha'   => ['required', new VerifyCaptcha]
        ];

    }
}
