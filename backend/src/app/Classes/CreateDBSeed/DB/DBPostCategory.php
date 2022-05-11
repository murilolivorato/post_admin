<?php


namespace App\Classes\CreateDBSeed\DB;


class DBPostCategory
{
    /**
     * @var array[]
     */
    protected static $start_db_data = [
        ['type_id' => 1 , 'title' => 'lançamentos' , 'url_title' => 'lancamentos'  ] ,
        ['type_id' => 1 , 'title' => 'informações' , 'url_title' => 'informacoes'  ] ,
        ['type_id' => 1 , 'title' => 'tecnologia' , 'url_title' => 'tecnologia'  ] ,
        ['type_id' => 1 , 'title' => 'arquitetura' , 'url_title' => 'arquitetura'  ] ,

        ['type_id' => 2 , 'title' => 'comprar imóvel' , 'url_title' => 'comprar-imovel'  ] ,
        ['type_id' => 2 , 'title' => 'alugar imóvel' , 'url_title' => 'alugar-imovel'  ] ,
        ['type_id' => 2 , 'title' => 'decoração' , 'url_title' => 'decoracao'  ] ,
        ['type_id' => 2 , 'title' => 'paisagismo' , 'url_title' => 'paisagismo'  ] ,
        ['type_id' => 2 , 'title' => 'reforma e construção' , 'url_title' => 'reforma-e-construcao'  ] ,
        ['type_id' => 2 , 'title' => 'investimento' , 'url_title' => 'investimento'  ]
    ];


    /**
     * @return array[]
     */
    public static function start_db() {
        return static::$start_db_data;
    }
}
