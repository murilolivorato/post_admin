<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserAdminTable;

class PostCategory extends Model
{
    use HasFactory,  UserAdminTable;

    protected $table    =  'post_categories';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'title',
        'url_title' ,
        'user_id' ,
        'user_ip'
    ];

    // RELATION SHIP
    public function Posts()
    {
        return $this->hasMany(Post::class , 'category_id' );
    }

    public static function getLastCreatedbyUser( $id_user) {

        return static::where('user_id', $id_user  )->orderBy('id', 'desc')->first();

    }

}
