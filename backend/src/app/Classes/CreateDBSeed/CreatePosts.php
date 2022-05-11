<?php

namespace App\Classes\CreateDBSeed;



use App\Classes\CreateDBSeed\Post\CreatePost;
use App\Classes\CreateDBSeed\Post\CreatePostGlImage;
use App\Classes\CreateDBSeed\Post\CreatePostImageGallery;
use App\Classes\CreateDBSeed\Post\CreatePostPostTagPivot;
use App\Classes\CreateDBSeed\Post\CreatePostImage;
use App\Classes\CreateDBSeed\Post\CreatePostVideo;
use App\Classes\CreateDBSeed\Post\Post\CreatePostFolder;
use App\Classes\CreateDBSeed\Post\Post\CreatePostImages;
use App\Models\Post;


class CreatePosts
{

    public function start()
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
