<?php


namespace App\Classes\Admin\Post\PostUser\Save;
use App\Models\PostUser;
use Illuminate\Http\Request;
use App\Models\UserAdmin;
use App\Classes\Helper\SetCharacter;

class SavePostUser
{
    /**
     * @var PostUser
     */
    protected $post_user;
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
     * @param PostUser $post_user
     * @param Request $request
     * @param UserAdmin $user
     */
    public function __construct(PostUser $post_user, Request $request , UserAdmin $user)
    {
        $this->post_user      = $post_user;
        $this->request            = $request;
        $this->user               = $user;
        $this->action             = $this->post_user->exists ? "isUpdating" : "isCreating";
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
     * @return PostUser
     */
    public function publish(){

        $this->post_user->title       = $this->request['title'];
        $this->post_user->url_title   = SetCharacter::makeUrlTitle($this->request['title']);

        $this->post_user->user_id     = $this->user->id;
        $this->post_user->user_ip     = ip2long($_SERVER['REMOTE_ADDR']);
        $this->post_user->save();

        return $this->post_user;


    }
}
