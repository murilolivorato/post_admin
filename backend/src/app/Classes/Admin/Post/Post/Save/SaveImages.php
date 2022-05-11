<?php


namespace App\Classes\Admin\Post\Post\Save;
use Image;
use File;

class SaveImages
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

            if (!empty($this->request['images'])):



               /* $count = 0;*/
                foreach($this->request['images'] as $key => $new_image) {
                    // IMAGE TYPE
                    $imageType = self::imageTypeName($new_image['index']);

                    // IF ALREADY HAS THIS IMAGE , UPDATE IT
                    if($this->post->Images->where('type' , $imageType )->isNotEmpty()){

                        $old_image = $this->post->Images->where('type' , $imageType )->first();

                        $this->updateImage($new_image , $old_image->image , $imageType );
                        continue;
                    }



                    $this->createImage($new_image , $imageType);

                    /*$count ++;*/
                }
             endif;

            return $this->post;
    }

    /**********************************************************************************
    CREATE IMAGE
     ***********************************************************************************/
     public function createImage($new_image , $imageType)
     {
         // IMAGE IS NULL
         if($new_image['image'] != ""){
                 // IF IS NOT NULL ADD IMAGE
                 if($this->makeUpload($new_image['image'])){
                     // CREATE IMAGE
                     $this->createImageDB($new_image, $imageType );
                 }
         }

     }

    /**
     * @param $index
     * @return string
     */
    protected static function imageTypeName($index){
            if($index == 0){
                return "display";
            }
            return "detail";
     }

    /**
     * @param $new_image
     * @return bool|void
     */
    protected function makeUpload($new_image){
         $oldlocation = public_path($this->post->PathURLTemp . "/" . $new_image);
         $newlocation = public_path($this->post->PathURL ."/". $new_image);


         // RELOCATE , THEN SAVE IN DB
         if (File::move($oldlocation, $newlocation)) {
                return true;
         }
     }


    /**********************************************************************************
    UPDATE IMAGE
     ***********************************************************************************/
    public function updateImage($new_image , $old_image , $imageType){


        // if is different than old image
        if($new_image['image'] != $old_image){
            // IF IS NOT NULL ADD IMAGE
            if($new_image['image'] != ""){
                if($this->makeUpload($new_image['image'])) {
                    // CREATE THE IMAGE
                    $this->updateImageDB($new_image, $imageType);
                }
                return;
            }

            // DELETE THE IMAGE
            $this->deleteImage($old_image , $imageType );

        }
    }




    /**********************************************************************************
    DELETE IMAGE DISPLAY
     ***********************************************************************************/
    protected function deleteImage($old_image , $imageType ){

        // old image
        $old_image_url = $this->post->ImageFolderImages . $old_image;

        // delete image
        File::delete(public_path($old_image_url));

        // delete image from DB
        $this->deleteImageDB($imageType);

    }



    /**********************************************************************************
    ADD IMAGE
     ***********************************************************************************/
    public function createImageDB($image_obj , $imageType){
        // Image Number Reference
        /*$image_number =  (int) $index + 1;*/

        // create image
        $this->post->Images()->create([ 'type'       => $imageType  ,
                                         'image'      => $image_obj['image'] ,
                                         'title'      => $image_obj['title'] ,
                                         'position'   => $image_obj['position']  ,
                                         'user_id'    => $this->user->id ,
                                         'user_ip'    => ip2long($_SERVER['REMOTE_ADDR']) ]);


    }



    /**********************************************************************************
    UPDATE IMAGE
     ***********************************************************************************/

    public function updateImageDB($image_obj , $type_image){
        // Image Number Reference
    /*    $type_image =  (int) $index + 1;*/

        // create image
        $this->post->Images()->where('type' , (int) $type_image )->update([ 'type'       => $type_image ,
                                                                            'image'      => $image_obj['image'] ,
                                                                            'title'      => $image_obj['title'] ,
                                                                            'position'   => $image_obj['position']  ,
                                                                            'user_id'    => $this->user->id ,
                                                                            'user_ip'    => ip2long($_SERVER['REMOTE_ADDR']) ]);
    }


    /**********************************************************************************
    DELETE IMAGE
     ***********************************************************************************/

    public function deleteImageDB($imageType){

        // create image
        $this->post->Images()->where('type' , $imageType  )->delete();
    }



}
