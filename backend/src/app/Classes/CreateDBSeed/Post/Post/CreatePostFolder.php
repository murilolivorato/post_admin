<?php


namespace App\Classes\CreateDBSeed\Post\Post;
use App\Classes\Helper\Hash;
use File;
use App\Models\Post;

class CreatePostFolder
{
    public  function  handle(Post $post){

        // SAVE PROP FOLDER IN DB
        $this->savePropFolderDB($post);
        // MAKE FOLER
        $this->makeFolderDirectory($post->PathURL);

    }

    protected function savePropFolderDB(Post $post){
         $post->folder = Hash::folder($post->id);
         $post->save();

    }
    // CREATE ACTION
    protected function makeFolderDirectory($folder_path_url){

        // create directory
        File::makeDirectory( public_path($folder_path_url) , 0755, true);

    }
}
