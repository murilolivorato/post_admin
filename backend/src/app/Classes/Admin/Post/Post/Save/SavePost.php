<?php


namespace App\Classes\Admin\Post\Post\Save;

use App\Classes\Helper\SetCharacter;
use App\Models\Post;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class SavePost
{
    /**
     * @param Post $post
     * @param Request $request
     * @param UserAdmin $user
     */
    public function __construct(Post $post, Request $request, UserAdmin $user )
    {
        $this->post        = $post;
        $this->request     = $request;
        $this->user        = $user;
        $this->action      = ! $this->post->exists  ? "create" : "update";
    }

    /**
     * @return Request
     */
    public function request(){
        return  $this->request;
    }

    /**
     * @return UserAdmin
     */
    public function user(){
        return  $this->user;
    }

    /**
     * @return string
     */
    public function action(){
        return  $this->action;
    }

    /**
     * @return mixed
     */
    public function publish(){


        // POST FIELDSS
        $this->post->status            = $this->request['status'];
        $this->post->title             = $this->request['title'];
        $this->post->type_id           = 1;
        $this->post->url_title         = SetCharacter::makeUrlTitle($this->request['title']);
        $this->post->sub_title         = $this->request['sub_title'];
        $this->post->category_id       = $this->request['category_id'];
        $this->post->post_user_id      = $this->request['post_user_id'];
        $this->post->short_description = $this->request['short_description'];
        $this->post->description       = $this->request['description'];
        $this->post->key_words         = $this->request['key_words'];
        $this->post->post_date         = $this->request['post_date'];

        if($this->action == "create"){
             $this->post->folder            = $this->makeTempCode();
        }

        $this->post->user_id = $this->user->id;
        $this->post->user_ip = ip2long($_SERVER['REMOTE_ADDR']);

        $this->post->save();

        return Post::find($this->post->id);
    }


    /**
     * @return string
     */
    protected function makeTempCode(){
        return "temp_" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);
    }



}
