<?php


namespace App\Classes\CreateDBSeed\DB;


class DBPostTag
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        ['title' => 'lançamentos' , 'url_title' => 'lancamentos'  ] ,
        ['title' => 'mercado' , 'url_title' => 'mercado'  ] ,
        ['title' => 'dinheiro' , 'url_title' => 'dinehiro'  ] ,
        ['title' => 'decoração' , 'url_title' => 'decoracao'  ] ,
        ['title' => 'dicas' , 'url_title' => 'dicas'  ] ,
        ['title' => 'novidades' , 'url_title' => 'novidades'  ] ,
        ['title' => 'arquitetura' , 'url_title' => 'arquitetura'  ] ,
        ['title' => 'design' , 'url_title' => 'design'  ] ,
        ['title' => 'imóveis na planta' , 'url_title' => 'imoveis-na-planta'  ] ,
        ['title' => 'primeiro imovel' , 'url_title' => 'primeiro-imovel'  ] ,
        ['title' => 'finnaciamento' , 'url_title' => 'finnaciamento'  ] ,
        ['title' => 'paisagismo' , 'url_title' => 'paisagismo'  ] ,
        ['title' => 'sustentabilidade' , 'url_title' => 'sustentabilidade'  ] ,
        ['title' => 'restauração' , 'url_title' => 'restauração'  ] ,
        ['title' => 'construção civil' , 'url_title' => 'construcao civil'  ]
    ];

    /**
     * @return \string[][]
     */
    public static function start_db() {
        return static::$start_db_data;
    }
}
