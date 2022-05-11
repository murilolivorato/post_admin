<?php


namespace App\Classes\Admin\Post\Post\Destroy;
use File;

/**
 *
 */
class DeleteFolder
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
     * @param $post
     */
    public function __construct($post){
        $this->post                 = $post->destroy();
        $this->request              = $post->request();
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
    public function destroy()
    {

        // DELETE FOLDER
        File::deleteDirectory(public_path($this->post->PathURL));

        return $this->post;
    }
}
