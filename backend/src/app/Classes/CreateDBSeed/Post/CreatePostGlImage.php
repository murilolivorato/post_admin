<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:59
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\Post;
use App\Models\PostGlImage;

class CreatePostGlImage
{
    public function  handle(Post $post)
    {
        $post = Post::find($post->id);
        PostGlImage::factory()->count(20)->create(['gallery_id'    => $post->ImageGallery->id]);
    }
}
