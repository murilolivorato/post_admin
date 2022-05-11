<?php


namespace App\Classes\Admin\Post\PostTag\Save;
use App\Models\PostTag;


class MakePostTagData
{

    /**
     * @var
     */
    protected $post_tag;
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
     * @param $post_tag
     */
    public function __construct($post_tag)
    {
        $this->post_tag          = $post_tag->publish();
        $this->request           = $post_tag->request();
        $this->action            = $post_tag->action();
        $this->user              = $post_tag->user();
    }

    /**
     * @return mixed
     */
    private function NewRecordId(){
        //IF IS CREATING , GET THE LAS RECORD / IF IS UPDATING JUST GET ID REQUEST
        return $this->action == "isUpdating"?  $this->request['id']
                                            :  PostTag::orderBy('created_at', 'desc')->where('user_id' , $this->user->id )->first()->{$this->primary_key};
    }

    /**
     * @return int|string
     */
    private function CountPost(){
        return $this->action == "isUpdating" ? count(PostTag::find($this->request[$this->primary_key])->Posts)
                                             : '0';

    }

    /**
     * @return array|void
     */
    public function publish(){
        if($this->post_tag){
            return [
                'success'    => true ,
                'new_record' => [
                    'index'                => $this->request['index'],
                    'id'                   => $this->NewRecordId(),
                    'posts_count'          => $this->CountPost(),
                    'title'                => $this->request['title'],
                    'url_title'            => $this->request['url_title']
                ]
            ];
        }
    }
}
