<?php


namespace App\Classes\CreateDBSeed\DB;


class DBPostType
{
    /**
     * @var \string[][]
     */
    protected static $start_db_data = [
        ['title' => 'Notícias ' , 'url_title' => 'noticias'  ] ,
        ['title' => 'Dicas ' , 'url_title' => 'dicas'  ]
    ];


    /**
     * @return \string[][]
     */
    public static function start_db() {
        return static::$start_db_data;
    }
}
