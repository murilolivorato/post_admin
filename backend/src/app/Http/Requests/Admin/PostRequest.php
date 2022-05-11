<?php


namespace App\Http\Requests\Admin;
use App\Classes\Auth\VerifyAuthRequest;
use App\Models\User;
use Auth;
use JWTAuth;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\VerifyUniqueField;

class PostRequest extends FormRequest
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
            'category_id'         => 'required|min:1' ,
            'post_user_id'        => 'required|min:1' ,
            'post_tag_id'         => 'required|min:1' ,
            'title'               => ['required'  ,  (new VerifyUniqueField())->setPrimarId($this->id)->setModel('posts') ] ,
            'description'         => 'required|min:3' ,
            'post_date'           => 'required' ,
        ];
    }
}
