<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostVideo extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table    =  'post_videos';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'video_website_id',
        'post_id',
        'title' ,
        'reference' ,
        'url' ,
        'user_id' ,
        'user_ip'
    ];

    public function videoWebSite(){
        return $this->belongsTo(VideoWebsite::class ,'video_website_id' );
    }

    public function post(){
        return $this->belongsTo(Post::class ,'prop_new_id' );
    }
}
