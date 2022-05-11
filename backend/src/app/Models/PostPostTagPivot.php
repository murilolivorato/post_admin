<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPostTagPivot extends Model
{
    use HasFactory;

    protected $table    =  'post_post_tags';
    public  $timestamps = false;
    protected $fillable = [
        'post_id' ,
        'post_tag_id' ,
    ];

}
