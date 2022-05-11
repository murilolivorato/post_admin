<?php


namespace App\Classes\Admin\Post\Post;
use App\Classes\ImageResize\ImageResize;
use App\Classes\Upload\UploadOneImage;

class UploadImage extends UploadOneImage
{
    /**
     * @return void
     */
    public function resizeImage(){

        // RESIZE IMAGE
        ImageResize::process($this->oldLocation , $this->newLocation , 800 , 460 );

    }

}
