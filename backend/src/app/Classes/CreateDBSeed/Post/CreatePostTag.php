<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:57
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Classes\CreateDBSeed\DB\DBPostTag;
use App\Models\PostTag;

class CreatePostTag
{
    public function  handle()
    {
        /*----------------------------------------------------------    PROP TYPE CATEGORY */
        $post_tags = DBPostTag::start_db();

        /*-------- PROP TYPE CATEGORY */
        foreach($post_tags as $item) {
            PostTag::factory()->create($item);
        }

    }
}
