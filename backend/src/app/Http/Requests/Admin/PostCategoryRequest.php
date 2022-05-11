<?php


namespace App\Http\Requests\Admin;
use App\Rules\VerifyUniqueField;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;
use Auth;
use App\Classes\Auth\VerifyAuthRequest;


class PostCategoryRequest extends FormRequest
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
     * new ValidadeCNPJ() ,
     * @return array
     */
    public function rules()
    {
        return [
            'title'               => ['required'  , (new VerifyUniqueField())->setPrimarId($this->id)->setModel('post_categories')] ,
        ];
    }
}
