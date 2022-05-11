<?php


namespace App\Classes\Admin\Post\PostUser\Save;
use App\Models\PostUser;

class MakePostUserData
{

    /**
     * @var
     */
    protected $post_user;
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
     * @param $post_user
     */
    public function __construct($post_user)
    {
        $this->post_user         = $post_user->publish();
        $this->request           = $post_user->request();
        $this->action            = $post_user->action();
        $this->user              = $post_user->user();
    }

    /**
     * @return mixed
     */
    private function NewRecordId(){
        //IF IS CREATING , GET THE LAS RECORD / IF IS UPDATING JUST GET ID REQUEST
        return $this->action == "isUpdating"?  $this->request['id']
                                            :  PostUser::orderBy('created_at', 'desc')->where('user_id' , $this->user->id )->first()->{$this->primary_key};
    }

    /**
     * @return int|string
     */
    private function CountPost(){
        return $this->action == "isUpdating" ? count(PostUser::find($this->request[$this->primary_key])->Posts)
                                             : '0';

    }

    /**
     * @return array|void
     */
    public function publish(){
        if($this->post_user){
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
