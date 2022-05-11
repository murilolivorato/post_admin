<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostUnImage extends Model
{
    use  HasFactory, UserAdminTable;

    protected $table    =  'post_images';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'post_id' ,
        'type',
        'image' ,
        'position' ,
        'title',
        'user_id' ,
        'user_ip'
    ];


    public static function verifyImageExists($image , $gallery_id) {
        return static::where('post_id', $gallery_id )->where('image', $image )->first();
    }

    public function post(){
        return $this->belongsTo(Post::class ,'post_id' );
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
