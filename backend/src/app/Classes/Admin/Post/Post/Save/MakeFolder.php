<?php


namespace App\Classes\Admin\Post\Post\Save;

use App\Classes\Helper\Hash;
use File;

class MakeFolder
{
    /**
     * @var
     */
    protected $post;
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $action;

    /**
     * @param $post
     */
    public function __construct($post){
        $this->post           = $post->publish();
        $this->request        = $post->request();
        $this->user           = $post->user();
        $this->action         = $post->action();
    }

    /**
     * @return mixed
     */
    public function request(){
        return  $this->request;
    }

    /**
     * @return mixed
     */
    public function user(){
        return  $this->user;
    }

    /**
     * @return mixed
     */
    public function action(){
        return  $this->action;
    }

    /**
     * @return mixed
     */
    public function publish()
    {
        // IS NOT UPDATING
        if($this->action == "create"){
            $this->create_folder();
        }

        return $this->post;

    }

    /**
     * @return void
     */
    protected function create_folder(){
        // IF IS EMPTY FOLDER
        $this->post->folder            = Hash::folder($this->post->id);
        $this->post->save();

        $this->makeFolderDirectory($this->post->PathURL);
    }

    // CREATE ACTION

    /**
     * @param $folder_path_url
     * @return void
     */
    protected function makeFolderDirectory($folder_path_url){
        // create directory
        File::makeDirectory( public_path($folder_path_url) , 0755, true);
    }
}
