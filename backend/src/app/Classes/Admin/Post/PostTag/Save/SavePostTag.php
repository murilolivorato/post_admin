<?php


namespace App\Classes\Admin\Post\PostTag\Save;
use App\Models\PostTag;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use App\Classes\Helper\SetCharacter;

class SavePostTag
{
    /**
     * @var PostTag
     */
    protected $post_category;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var string
     */
    protected $action;
    /**
     * @var UserAdmin
     */
    protected $user;


    /**
     * @param PostTag $post_category
     * @param Request $request
     * @param UserAdmin $user
     */
    public function __construct(PostTag $post_category, Request $request , UserAdmin $user)
    {
        $this->post_category      = $post_category;
        $this->request            = $request;
        $this->user               = $user;
        $this->action             = $this->post_category->exists ? "isUpdating" : "isCreating";
    }

    /**
     * @return Request
     */
    public function request(){
        return  $this->request;
    }

    /**
     * @return string
     */
    public function action(){
        return  $this->action;
    }

    /**
     * @return UserAdmin
     */
    public function user(){
        return  $this->user;
    }


    /**
     * @return PostTag
     */
    public function publish(){

        $this->post_category->title       = $this->request['title'];
        $this->post_category->url_title   = SetCharacter::makeUrlTitle($this->request['title']);

        $this->post_category->user_id     = $this->user->id;
        $this->post_category->user_ip     = ip2long($_SERVER['REMOTE_ADDR']);
        $this->post_category->save();

        return $this->post_category;


    }
}
