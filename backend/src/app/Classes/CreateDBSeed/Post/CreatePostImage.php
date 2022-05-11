<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:59
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\PostUnImage;

class CreatePostImage
{
    public function  handle()
    {
        factory(PostUnImage::class, 20)->create();
    }
}
