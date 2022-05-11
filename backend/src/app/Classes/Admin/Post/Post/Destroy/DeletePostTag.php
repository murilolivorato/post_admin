<?php


namespace App\Classes\Admin\Post\Post\Destroy;


class DeletePostTag
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

        // PLAN FEATURE
        $this->post->PostTags()->detach();

        return $this->post;
    }
}
