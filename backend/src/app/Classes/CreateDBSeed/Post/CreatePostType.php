<?php


namespace App\Classes\CreateDBSeed\Post;
use App\Classes\CreateDBSeed\DB\DBPostType;
use App\Models\PostType;

class CreatePostType
{
    public function  handle()
    {
        /*----------------------------------------------------------    PROP TYPE CATEGORY */
        $post_type = DBPostType::start_db();

        /*-------- PROP TYPE CATEGORY */
        foreach($post_type as $item) {
            PostType::factory()->create($item);
        }
    }
}
