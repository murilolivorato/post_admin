<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:58
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\Post;
use App\Models\PostGlImage;
use App\Models\PostImageGallery;

class CreatePostImageGallery
{
    public function  handle(Post $post)
    {
        PostImageGallery::factory()->create([ 'post_id'    => $post->id ])->each(function($post_gallery)  {
            PostGlImage::factory()->count(20)->create(['gallery_id'    => $post_gallery->id]);
        });
    }
}
