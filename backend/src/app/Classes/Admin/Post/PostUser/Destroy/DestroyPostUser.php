<?php


namespace App\Classes\Admin\Post\PostUser\Destroy;
use App\Models\PostUser;

class DestroyPostUser
{
    /**
     * @var PostUser
     */
    protected $post_user;
    /**
     * @var
     */
    protected $index;

    /**
     * @param PostUser $post_user
     * @param $index
     */
    public function __construct(PostUser $post_user , $index)
    {
        $this->post_user      = $post_user;
        $this->index         = $index;
    }

    /**
     * @return mixed
     */
    public function index(){
        return  $this->index;
    }

    /**
     * @return mixed
     */
    public function destroy()
    {
        // DELETE ASSOCIATED
        $this->post_user->delete();

        return $this->index;
    }
}
