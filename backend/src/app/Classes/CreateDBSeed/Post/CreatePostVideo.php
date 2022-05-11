<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:59
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\Post;
use App\Models\PostVideo;

class CreatePostVideo
{
    public function  handle(Post $post)
    {
        PostVideo::factory()->count(20)->create(['post_id'    => $post->id]);
    }
}
