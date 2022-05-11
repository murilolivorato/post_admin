<?php


namespace App\Classes\Admin\Post\PostTag\Destroy;
use App\Models\PostTag;

class DestroyPostTag
{
    /**
     * @var PostTag
     */
    protected $PostTag;
    /**
     * @var
     */
    protected $index;

    /**
     * @param PostTag $PostTag
     * @param $index
     */
    public function __construct(PostTag $PostTag , $index)
    {
        $this->PostTag       = $PostTag;
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
        $this->PostTag->delete();

        return $this->index;
    }
}
