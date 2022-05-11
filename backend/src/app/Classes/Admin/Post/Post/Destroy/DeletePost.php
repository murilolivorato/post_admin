<?php


namespace App\Classes\Admin\Post\Post\Destroy;


class DeletePost
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
     * @return bool
     */
    public function destroy()
    {
        // DELETE POST
        $this->post->delete();

        return true;
    }
}
