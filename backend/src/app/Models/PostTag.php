<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostTag extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table = 'post_tags';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'title',
        'url_title' ,
        'user_id' ,
        'user_ip'
    ];

    // RELATION SHIP
    public function Posts() {
        return $this->belongsToMany(Post::class , 'post_post_tags' , 'post_tag_id'  , 'post_id');
    }


    public static function getLastCreatedbyUser( $id_user) {
        return static::where('user_id', $id_user  )->orderBy('id', 'desc')->first();

    }

    public function ownedBy(UserAdmin $user) {
        return $this->id_user == $user->id;
    }

}
