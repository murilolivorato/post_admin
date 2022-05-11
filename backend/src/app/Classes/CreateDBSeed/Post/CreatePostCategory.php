<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:56
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Classes\CreateDBSeed\DB\DBPostCategory;
use App\Models\PostCategory;

class CreatePostCategory
{
    public function  handle()
    {
        /*----------------------------------------------------------    PROP TYPE CATEGORY */
        $post_category = DBPostCategory::start_db();

        /*-------- PROP TYPE CATEGORY */
        foreach($post_category as $item) {
            PostCategory::factory()->create($item);
        }


    }
}
