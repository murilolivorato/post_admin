<?php


namespace App\Http\Requests;

use App\Rules\VerifyCaptcha;
use App\Rules\ValidateCPF;
use Illuminate\Foundation\Http\FormRequest;

class LoanBudgetRequest extends FormRequest
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


        $propertyRequest = self::propertyRequest($this->type_id);
        $general         = self::generalRequest();
        $secondOwner     = self::secondOwnerRequest($this->has_two_owner);


        return array_merge ($propertyRequest , $general , $secondOwner);
    }


    protected static function  generalRequest(){
            return ['loan_time'                  => 'required',
                    'owner_one_name'             => 'required|min:3|max:32',
                    'owner_one_last_name'        => 'required|min:3|max:32',
                    'owner_one_cpf'              => ['required' , new ValidateCPF ] ,
                    'owner_one_date_birth'       => 'required',
                    'owner_one_email'            => 'required|email',
                    'owner_one_phone_number'     => 'required|min:3|max:32',
                    'contact_preference'         => 'required|min:1|max:32',
                    'contact_time'               => 'required|min:1|max:32',
                    'captcha'                    => 'required', new VerifyCaptcha  ] ;
    }

    protected static function  secondOwnerRequest($has_two_owner){
        if(!$has_two_owner){
           return [];
        }

        return ['owner_two_name'                  => 'required|min:3|max:32' ,
                'owner_two_last_name'             => 'required|min:3|max:32' ,
                'owner_two_cpf'                   => ['required' , new ValidateCPF ]  ,
                'owner_two_date_birth'            => 'required' ];
    }

    protected static function  propertyRequest($type_id){

        // IMAOVEIS NOVOS
        if($type_id == 1){
            return [
                'price_property'             => 'required|numeric|min:50000|max:100000000' ,
                'price_loan'                 => 'required|numeric|min:10000|max:100000000' ,
            ];
        }

        // TERRENO
        if($type_id == 2){
            return [
                'price_land'             => 'required|numeric|min:50000|max:100000000' ,
                'price_loan'             => 'required|numeric|min:10000|max:100000000' ,
            ];
        }

        // CONSTRUÇÃO
        if($type_id == 3){
            return [
                'price_construction'         => 'required|numeric|min:50000|max:100000000' ,
                'price_loan'                 => 'required|numeric|min:10000|max:100000000' ,
            ];
        }

        // TERRENO + CONSTRUÇÃO
        if($type_id == 4){
            return [
                'price_land'             => 'required|numeric|min:30000|max:100000000' ,
                'price_construction'     => 'required|numeric|min:10000|max:100000000' ,
                'price_loan'             => 'required|numeric|min:10000|max:100000000' ,
            ];
        }

        return [];

    }
}
