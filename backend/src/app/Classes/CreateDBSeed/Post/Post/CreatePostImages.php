<?php


namespace App\Classes\CreateDBSeed\Post\Post;

use App\Classes\CreateDBSeed\DB\DBPostImages;
use App\Classes\Helper\MakeFileName;
use App\Models\Post;
use Image;
use File;

class CreatePostImages
{
    public  function  handle(Post $post){
        $list = DBPostImages::all();

        // UPLOAD DETAIL
        $this->uploadImageProfile($list[array_rand($list)]['images'] ,  $post , 'detail');

        // UPLOAD LIST
        $this->uploadImageProfile($list[array_rand($list)]['images'] ,  $post , 'display');

    }

    // UPLOAD IMAGE
    public function uploadImageProfile($list , Post $post , $type ){
        $newImageName    =  MakeFileName::encriptName($list[$type]);

        $oldlocation = public_path("/assets/create/post/" .  $list[$type]);
        $newlocation = public_path($post->PathURL . "/" . $newImageName);

        // RELOCATE , THEN SAVE IN DB
        if(File::copy($oldlocation, $newlocation)){
            $this->saveImageDB($post , $newImageName , $type);

        }
    }

    public function saveImageDB(Post $post , $newImageName , $type){

        // CREATE IMAGE
        $post->Images()->create([ 'image'      => $newImageName ,
                                  'title'      => null ,
                                  'position'   => null ,
                                  'type'       => $type ,
                                  'user_ip'    => 1 ,
                                  'user_id'    => $post->user_id  ]);

    }

}
