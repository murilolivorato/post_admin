<?php


namespace App\Classes\Admin\Post\Post\Save;


class SaveFileGallery
{
    /**
     * @var
     */
    protected $post;
    /**
     * @var
     */
    protected $request;
    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $action;

    /**
     * @param $post
     */
    public function __construct($post){
        $this->post           = $post->publish();
        $this->request        = $post->request();
        $this->user           = $post->user();
        $this->action         = $post->action();
    }

    /**
     * @return mixed
     */
    public function request(){
        return  $this->request;
    }

    /**
     * @return mixed
     */
    public function user(){
        return  $this->user;
    }

    /**
     * @return mixed
     */
    public function action(){
        return  $this->action;
    }

    /**
     * @return mixed
     */
    public function publish()
    {
        // SAVE
        if($this->request['file_gallery']) {
            if ($this->request['file_gallery']['gallery_id']){
                        $this->post->ImageGallery ? $this->saveGallery('update', $this->request['file_gallery'])
                                                  : $this->saveGallery('create', $this->request['file_gallery']);
             }
        }

        // IF HAS DELETE
        if($this->post->FileGallery){
            if($this->request['file_gallery']['gallery_id'] == "") {
                $this->deleteGallery();
            }
        }

        return $this->post;
    }

    /**********************************************************************************
    DELETE  GALLERY
     ***********************************************************************************/
    public function deleteGallery(){

        $this->post->FileGallery()->delete();
        return;

    }


    /**********************************************************************************
    SAVE GALLERY
     ***********************************************************************************/
    public function saveGallery($action , $gallery){


        // action : CREATE ? UPDATE
        $this->post->FileGallery()->$action([ 'gallery_id'          => $gallery['gallery_id'] ,
                                              'title'               => $gallery['title'] ,
                                              'description'         => $gallery['description'] ,
                                              'user_id'             => $this->user->id ,
                                              'user_ip'             => ip2long($_SERVER['REMOTE_ADDR']) ]);


    }
}
