<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:57
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\Post;
use App\Classes\CreateDBSeed\Post\Post\CreatePostFolder;
use App\Classes\CreateDBSeed\Post\Post\CreatePostImages;

class CreatePost
{
    public function  handle()
    {
        Post::factory(100)->create()->each(function($post)   {
            $tasks = [
                    CreatePostFolder::class ,
                    CreatePostImages::class,
                    CreatePostPostTagPivot::class,
                    CreatePostImageGallery::class,
                    CreatePostVideo::class,
                ];

            foreach ($tasks as $task){
                (new $task)->handle($post);
            }

        });
    }
}
