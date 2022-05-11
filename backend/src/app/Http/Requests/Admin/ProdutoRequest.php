<?php


namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class ProdutoRequest extends FormRequest
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
            'category_id'         => 'required|min:1' ,
            'title'               => 'required|min:3|max:250' ,
            'post_date'           => 'required' ,
            'description'         => 'required|min:3'
        ];
    }
}
