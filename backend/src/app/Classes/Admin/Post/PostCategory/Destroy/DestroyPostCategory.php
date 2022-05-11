<?php


namespace App\Classes\Admin\Post\PostCategory\Destroy;
use App\Models\PostCategory;

class DestroyPostCategory
{
    /**
     * @var PostCategory
     */
    protected $postCategory;
    /**
     * @var
     */
    protected $index;

    /**
     * @param PostCategory $postCategory
     * @param $index
     */
    public function __construct(PostCategory $postCategory , $index)
    {
        $this->postCategory       = $postCategory;
        $this->index              = $index;
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
        $this->postCategory->delete();

        return $this->index;
    }
}
