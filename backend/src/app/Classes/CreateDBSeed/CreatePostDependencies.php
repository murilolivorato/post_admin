<?php


namespace App\Classes\CreateDBSeed;

use App\Classes\CreateDBSeed\Post\CreatePostType;
use App\Classes\CreateDBSeed\Post\CreatePostCategory;
use App\Classes\CreateDBSeed\Post\CreatePostTag;
use App\Classes\CreateDBSeed\Post\CreatePostUser;

class CreatePostDependencies
{
    public function start()
    {

        $tasks = [
            CreatePostType::class ,
            CreatePostCategory::class,
            CreatePostUser::class,
            CreatePostTag::class,
        ];


        foreach ($tasks as $task){
            (new $task)->handle();
        }



    }
}
