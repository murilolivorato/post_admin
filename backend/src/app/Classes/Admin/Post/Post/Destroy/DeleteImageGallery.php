<?php


namespace App\Classes\Admin\Post\Post\Destroy;


class DeleteImageGallery
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
        if($this->post->ImageGallery){
            $this->post->ImageGallery()->delete();
        }

        return $this->post;
    }
}
