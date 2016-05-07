<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','teacher_id', 'user_id','message', 'seen'
    ];

}
