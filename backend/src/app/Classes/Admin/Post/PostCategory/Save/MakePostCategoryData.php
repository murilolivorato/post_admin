<?php


namespace App\Classes\Admin\Post\PostCategory\Save;
use App\Models\PostCategory;


class MakePostCategoryData
{

    /**
     * @var
     */
    protected $post_category;
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $action;
    /**
     * @var
     */
    protected $user;
    /**
     * @var string
     */
    protected $primary_key = 'id';

    /**
     * @param $post_category
     */
    public function __construct($post_category)
    {
        $this->post_category     = $post_category->publish();
        $this->request           = $post_category->request();
        $this->action            = $post_category->action();
        $this->user              = $post_category->user();
    }

    /**
     * @return mixed
     */
    private function NewRecordId(){
        //IF IS CREATING , GET THE LAS RECORD / IF IS UPDATING JUST GET ID REQUEST
        return $this->action == "isUpdating"?  $this->request['id']
                                            :  PostCategory::orderBy('created_at', 'desc')->where('user_id' , $this->user->id )->first()->{$this->primary_key};
    }

    /**
     * @return int|string
     */
    private function CountPost(){
        return $this->action == "isUpdating" ? count(PostCategory::find($this->request[$this->primary_key])->Posts)
                                             : '0';

    }

    /**
     * @return array|void
     */
    public function publish(){
        if($this->post_category){
            return [
                'new_record' => [
                    'index'                => $this->request['index'],
                    'id'                   => $this->NewRecordId(),
                    'posts_count'          => $this->CountPost(),
                    'title'                => $this->request['title'] ,
                    'url_title'            => $this->request['url_title']
                ]
            ];
        }
    }
}
