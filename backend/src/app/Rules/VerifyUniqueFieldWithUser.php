<?php


namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class VerifyUniqueFieldWithUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $model;
    protected $primary_key;
    protected $primary_id_value;
    protected $user_id;
    protected $user_col_name;



    public function setModel($model){
        $this->model = $model;
        return $this;
    }

    public function setPrimaryKey($primary_key = 'id'){
        $this->primary_key = $primary_key;
        return $this;
    }

    public function setPrimarId($primary_id_value){
        $this->primary_id_value = $primary_id_value;
        return $this;
    }

    public function setUserColName($user_col_name = null){
        $this->user_col_name = $user_col_name;
        return $this;
    }

    public function setUserId($user_id = null){
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // SETA O NOME DO CAMPO
        $this->nome_do_campo = $attribute;

        // ESTÁ ATUALIZANDO
        if($this->primary_id_value ){
            return $this->validateUpdate($attribute , $value);
        }

        // ESTÁ CRIANDO
        return $this->validateCreate($attribute , $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'este ' . $this->nome_do_campo . ' já está cadastrado';
    }

    private function validateUpdate($attribute , $value)
    {


        // ENCONTRA A EMPRESA PELO NOME

        $creating_model  =  DB::table($this->model)->where($attribute , $value)->where($this->user_col_name , $this->user_id )->first();

        // SE ENCONTRAR ESTA EMPRSA
        if ($creating_model) {

            // VERIFICA SE É A MESMA QUE ESTÁ ATUALIZANDO
            $updating_model = DB::table($this->model)->where($this->primary_key , $this->primary_id_value)->first();

            // SE FOR DIFERENCA RETORNA FALSO
            if($creating_model != $updating_model){
                return false;
            }
        }
        return true;


    }

    private function validateCreate($attribute , $value)
    {
        // IF BOOK ISBN EXISTS RETURN FALSE
        return DB::table($this->model)->where($attribute , $value)->where($this->user_col_name , $this->user_id )->first() ?  false
            :  true;
    }
}