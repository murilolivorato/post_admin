<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostImageGallery extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table    =  'post_image_galleries';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'folder',
        'post_id',
        'user_id' ,
        'user_ip'
    ];

    // RELATION   GALLERY
    public static function getLastCreatedbyUser( $id_user ) {
        $getLastCreatByUser =  static::where('user_id', $id_user  )->orderBy('id', 'desc')->first();
        return $getLastCreatByUser;
    }


    public function images()
    {
        return $this->hasMany(PostGlImage::class , 'gallery_id' );
    }


    public function countImages() {
        return $this->images()->selectRaw('gallery_id, count(*) as aggregate');
    }


    /* ------------  PHOTO PATH */
    public function getPathGalleryAttribute()
    {
        $userFolder =  $this->owner->folder;
        // if type is 1 - is a IMAGE otherwise is a FILE
        return $this->type_id == 1 ? "/assets/fotos/galerias/" . $userFolder . "/" . $this->folder : "/assets/imagens/icons";
    }

    public function getPathGalleryURLFileAttribute()
    {
        $userFolder =  $this->owner->folder;
        // if type is 1 - is a IMAGE otherwise is a FILE
        return "/assets/fotos/galerias/" . $userFolder . "/" . $this->folder;

    }
}
