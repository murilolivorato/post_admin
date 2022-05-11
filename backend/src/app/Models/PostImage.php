<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;


class PostImage extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table = 'post_images';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'type' ,
        'post_id',
        'title',
        'image',
        'position',

        'user_id' ,
        'user_ip'
    ];


    public function Post() {
        return $this->belongsTo(Post::class  , 'post_id');
    }

    public function getImagePathUrlAttribute(){

        /* $this->setImage(); */
      /*  return  $this->Post->ImageFolder.$this->image;*/
        return $this->Post->PathURL ."/" . $this->image;;
    }
}
