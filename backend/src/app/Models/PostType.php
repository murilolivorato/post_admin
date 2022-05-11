<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    use HasFactory;
    protected $table = 'post_types';
    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $fillable = [
        'title',
        'url_title',

        'user_id' ,
        'user_ip'
    ];

    // RELATION SHIP
    public function Posts()
    {
        return $this->hasMany(Post::class , 'type_id' );
    }
}
