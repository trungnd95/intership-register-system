<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifyTeacherAcceptance extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','teacher_id','acceptance'
    ];
    
    /**
     * Relationship
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function teacher()
    {
    	return $this->belongsTo('App\Teacher');
    }

}
