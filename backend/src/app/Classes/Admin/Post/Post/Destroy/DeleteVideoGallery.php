<?php


namespace App\Classes\Admin\Post\Post\Destroy;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use App\Models\Post;

class DeleteVideoGallery
{
    /**
     * @param Post $post
     * @param Request $request
     */
    public function __construct(Post $post, Request $request)
    {
        $this->post         = $post;
        $this->request      = $request;
    }


    /**
     * @return Request
     */
    public function request()
    {
        return $this->request;
    }


    /**
     * @return Post
     */
    public function destroy()
    {
        // DELETE VIDEO IF EXISTS
        if($this->post->Videos()->exists()){
            $this->post->Videos()->delete();
        }

        return $this->post;
    }
}
