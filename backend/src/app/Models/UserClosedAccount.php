<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\UserTable;

class UserClosedAccount extends Model
{
    use UserTable;

    protected $guarded  = ['id' , 'created_at' , 'updated_at'];
    protected $table    =  'user_closed_acount';
    protected $fillable = [
        'user_id',
        'content_course_vote',
        'student_sistem_vote',
        'suport_vote' ,
        'message' ,
        'user_ip'
    ];



    public function User()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
