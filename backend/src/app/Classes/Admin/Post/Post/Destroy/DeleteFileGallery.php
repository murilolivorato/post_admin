<?php


namespace App\Classes\Admin\Post\Post\Destroy;


class DeleteFileGallery
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
        if($this->post->FileGallery){
            $this->post->FileGallery()->delete();
        }

        return $this->post;
    }
}
