<?php
namespace App\Classes\Admin\Post\Post\Save;


class SaveVideoGallery
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
     * @return bool[]
     */
    public function publish()
    {

      // DELETE ALL VIDEOS
        if($this->action == 'update') {
            $this->deleteAllVideos();
        }

        // ADD VIDEOS
        if (!empty($this->request['video_gallery'])):

          /* $count_videos = count($this->post->Videos);*/

            foreach($this->request['video_gallery'] as $key => $video) {


           /*     if($this->action == 'update'){


                if($key + 1 > $count_videos){
                        $this->createVideoDisplay($video);
                    }

                    $this->updateVideoDisplay($video , $key );

                    continue;
                }*/

                    $this->createVideoDisplay($video);


            }



        endif;

        return ['success' => true ];
    }



    /**********************************************************************************
    DELETE IMAGE
     ***********************************************************************************/
    public function deleteAllVideos(){
        // SE EXISTE VIDEOS
        if($this->post->Videos()->exists()){
               $this->post->Videos()->delete();
        }


    }

    /**********************************************************************************
    CREATE VIDEOS
     ***********************************************************************************/
    public function createVideoDisplay($video){



        // action : CREATE ? UPDATE
        $this->post->Videos()->create([ 'video_website_id'     => $video['video_website_id'] ,
                                        'title'                => $video['title'] ,
                                        'description'          => $video['description'] ,
                                        'reference'            => $video['reference'] ,
                                        'user_id'              => $this->user->id ,
                                        'user_ip'              => ip2long($_SERVER['REMOTE_ADDR']) ]);


    }

    /**********************************************************************************
    UPDATE VIDEOS
     ***********************************************************************************/
    public function updateVideoDisplay($video , $index){

        // action : CREATE ? UPDATE
        $this->post->Videos[$index]->update(['video_website_id'     => $video['video_website_id'] ,
                                               'title'              => $video['title'] ,
                                               'description'        => $video['description'] ,
                                               'reference'          => $video['reference'] ,
                                                'user_id'           => $this->user->id ,
                                                'user_ip'           => ip2long($_SERVER['REMOTE_ADDR']) ]);


    }


    /**********************************************************************************
    DELETE IMAGE
     ***********************************************************************************/
    public function deleteVideoDisplay($index){
        // Image Number Reference
        $image_number = $index + 1;

        // create image
        $this->post->Videos()->where('num_video' , (int) $image_number  )->delete();
    }

}
