<?php


namespace App\Classes\CreateDBSeed\DB;


class DBPostImages
{
    /**
     * @var \string[][][]
     */
    protected static $start_db_data = [

        /* 1 */   [  'images' => ['detail' =>  '1_dl.jpg', 'display' =>  '1_list.jpg' ] ] ,
        /* 2 */   [  'images' => ['detail' =>  '2_dl.jpg', 'display' =>  '2_list.jpg' ] ] ,
        /* 3 */   [  'images' => ['detail' =>  '3_dl.jpg', 'display' =>  '3_list.jpg' ] ] ,
        /* 4 */   [  'images' => ['detail' =>  '4_dl.jpg', 'display' =>  '4_list.jpg' ] ] ,
        /* 5 */   [  'images' => ['detail' =>  '5_dl.jpg', 'display' =>  '5_list.jpg' ] ] ,
        /* 6 */   [  'images' => ['detail' =>  '6_dl.jpg', 'display' =>  '6_list.jpg' ] ] ,
        /* 7 */   [  'images' => ['detail' =>  '7_dl.jpg', 'display' =>  '7_list.jpg' ] ] ,
        /* 8 */   [  'images' => ['detail' =>  '8_dl.jpg', 'display' =>  '8_list.jpg' ] ] ,
        /* 9 */   [  'images' => ['detail' =>  '9_dl.jpg', 'display' =>  '9_list.jpg' ] ] ,
        /* 10 */  [  'images' => ['detail' =>  '10_dl.jpg', 'display' =>  '10_list.jpg' ] ]


    ];

    /**
     * @return \string[][][]
     */
    public static function all() {
        return static::$start_db_data;
    }
}
