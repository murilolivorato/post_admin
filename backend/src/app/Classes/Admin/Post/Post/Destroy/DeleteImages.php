<?php


namespace App\Classes\Admin\Post\Post\Destroy;
use File;

class DeleteImages
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
        // IF HAS GALLERY
        if($this->post->Images){
            // CREATE IMAGES
            foreach($this->post->Images as $image) {

                // DELETE THUMB FILE
                File::delete(public_path($image->ImagePathUrl));

                // DELETE DB
                $image->delete();

            }
        }



        return $this->post;
    }
}
