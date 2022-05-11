<?php


namespace App\Classes\Admin\Post\Post\Save;


class SavePostTag
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
        // attach
        $this->post->postTags()->sync($this->request['post_tag_id']);

        return $this->post;
    }
}
