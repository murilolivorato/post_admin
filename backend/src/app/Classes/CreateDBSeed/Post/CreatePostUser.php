<?php
/**
 * Created by PhpStorm.
 * UserPub: murilo
 * Date: 12/01/2019
 * Time: 17:57
 */

namespace App\Classes\CreateDBSeed\Post;
use App\Models\PostUser;

class CreatePostUser
{
    public function  handle()
    {
        PostUser::factory()->count(5)->create();
    }
}
