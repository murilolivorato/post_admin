<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;
use \App\Http\Controllers\Traits\FileGalleryDisplayTable;
use \App\Http\Controllers\Traits\ImageGalleryDisplayTable;
// Traits



class Post extends Model
{
    use FileGalleryDisplayTable;
    use ImageGalleryDisplayTable;
    use UserAdminTable;
    use HasFactory;

    protected $table    =  'posts';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $appends = ['path_url'];
    protected $fillable = [
        'status' ,
        'type_id' ,
        'category_id',
        'folder',
        'post_user_id' ,
        'url_title',
        'title' ,
        'sub_title' ,
        'short_description'  ,
        'description'  ,
        'key_words'  ,
        'post_date',
        'user_id' ,
        'user_ip'

    ];


    // relation
    public function PostType() {
        return $this->belongsTo(PostType::class , 'type_id');
    }
    public function PostCategory() {
        return $this->belongsTo(PostCategory::class , 'category_id');
    }
    public function PostUser() {
        return $this->belongsTo(PostUser::class , 'post_user_id');
    }

    public function PostTags() {
        return $this->belongsToMany(PostTag::class , 'post_post_tags', 'post_id'  , 'post_tag_id');
    }

    public function Images() {
        return $this->hasMany(PostImage::class , 'post_id');
    }

    public function ImagesDisplay() {
        return $this->hasOne(PostImage::class , 'post_id' )->where('type' , 'display')->latest();
    }

    public function ImagesDetail() {
        return $this->hasOne(PostImage::class , 'post_id' )->where('type' , 'detail')->latest();
    }

    public function FirstImage() {
        return count($this->Images) ?  $this->Images[0] : null;
    }

    public function Videos() {
        return $this->hasMany(PostVideo::class , 'post_id');
    }

    /* FILE GALLERY */
  /*  public function FileGallery(){

        return $this->hasOne(FileGallery::class , 'post_id');
    }*/

    /* IMAGE  GALLERY */
   /* public function ImageGallery(){

        return $this->hasOne(ImageGallery::class , 'post_id');
    }*/

    public static function GetByTitle($url_post ) {

        return static::where(compact('url_post'))->firstOrFail();
    }

    public function getPathURLAttribute()
    {
        return "/assets/arquivos/posts/" . $this['folder'];
    }

    public function getPathURLTempAttribute()
    {
        return "/assets/temp";
    }







}
