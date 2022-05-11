<?php


namespace App\Http\Requests\Admin;
use App\Classes\Auth\VerifyAuthRequest;
use Illuminate\Foundation\Http\FormRequest;


class UpdatePasswordUserAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // VERIFY USER ADMIN
        return VerifyAuthRequest::verifyAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'               => 'required|min:3|max:10' ,
            'password_confirmation'  => 'required|same:password'
        ];
    }
}
