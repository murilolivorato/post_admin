<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostGlImage extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table    =  'post_gl_images';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'gallery_id',
        'image' ,
        'title' ,
        'user_id' ,
        'user_ip'
    ];


    public static function verifyImageExists($image , $gallery_id) {
        return static::where('gallery_id', $gallery_id )->where('file', $image )->first();
    }

    public function imageGallery(){
        return $this->belongsTo(PostImageGallery::class ,'gallery_id' );
    }

    /* ------------  photo paths */
    public function baseDir(){
        return '/assets/fotos/galerias';
    }

    public function tempDir(){
        return '/assets/temp';
    }

    /* ------------  photo atributes */
    public function getPathPhotoAttribute($gallery_folder){
        return $this->baseDir()."/".$gallery_folder."/".$this->image;
    }

    public function getPathTempPhotoAttribute(){
        return $this->tempDir()."/".$this->image;
    }
}
