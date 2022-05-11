<?php


namespace App\Classes\Admin\Post\Post\Save;


class SaveImageGallery
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
        if($this->request['image_gallery']) {
            if($this->request['image_gallery']['gallery_id']) {

                $this->post->ImageGallery ? $this->saveGallery('update', $this->request['image_gallery'])
                                          : $this->saveGallery('create', $this->request['image_gallery']);
            }
        }


        // IF HAS DELETE
        if($this->post->ImageGallery){
            if($this->request['image_gallery']['gallery_id'] == "") {
                $this->deleteGallery();
            }
        }

        return $this->post;
    }

    /**********************************************************************************
    DELETE  GALLERY
     ***********************************************************************************/
    public function deleteGallery(){

        $this->post->ImageGallery()->delete();
        return;

    }


    /**********************************************************************************
    SAVE GALLERY
     ***********************************************************************************/
    public function saveGallery($action , $gallery){



        // action : CREATE ? UPDATE
        $this->post->ImageGallery()->$action([ 'gallery_id'          => $gallery['gallery_id'] ,
                                                'title'              => $gallery['title'] ,
                                                'description'        => $gallery['description'] ,
                                                'user_id'            => $this->user->id ,
                                                'user_ip'            => ip2long($_SERVER['REMOTE_ADDR']) ]);


    }

}
