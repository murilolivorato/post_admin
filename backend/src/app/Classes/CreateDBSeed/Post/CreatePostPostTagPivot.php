<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:58
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\Post;
use App\Models\PostPostTagPivot;

class CreatePostPostTagPivot
{
    public function  handle(Post $post)
    {
        PostPostTagPivot::factory()->create([ 'post_id'    => $post->id ]);
    }
}
