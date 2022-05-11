<?php

namespace App\Http\Controllers\Traits;

use App\Models\ImageGalleryDisplay;

trait ImageGalleryDisplayTable
{

    /* IMAGE DISPLAY */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ImageGallery(){

        return $this->morphOne(ImageGalleryDisplay::class , 'importable');
    }



    /**********************************************************************************
    VERIFY EXISTS GALLERY
     ***********************************************************************************/
    public function getImageGalleryExistsAttribute(){

        return  $this->ImageGallery ? true : false ;


    }

}
