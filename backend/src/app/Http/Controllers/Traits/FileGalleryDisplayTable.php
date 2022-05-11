<?php

namespace App\Http\Controllers\Traits;

use App\Models\FileGalleryDisplay;

trait FileGalleryDisplayTable
{

    /* IMAGE DISPLAY */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function FileGallery(){

        return $this->morphOne(FileGalleryDisplay::class , 'importable');
    }



    /**********************************************************************************
    VERIFY EXISTS GALLERY
     ***********************************************************************************/
    public function getFileGalleryExistsAttribute(){

        return   $this->FileGallery ? true : false ;


    }

}
