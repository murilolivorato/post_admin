<?php


namespace App\Http\Requests\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserCustomer;
use Auth;


class UpdateUserCustomerRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(! auth('user_admin')->user()){
            return false;
        }


        return User::where([
                               'id'          => auth('user_admin')->user()->id
                           ])->exists();
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'                 => 'required' ,
            'email'                  => 'required|email' ,
            'nome_completo'          => 'required|min:3' ,
            'apelido'                => 'required|min:3'
        ];
    }
}
