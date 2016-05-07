<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'id','user_name', 'email', 'password','full_name','student_code','class_name','birth_day',
        'phone_number','teacher_id','confirmed','confirmation_code','teacher_acceptance','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship
     */
    
    /**
     * Relation between student and teacher
     * 1 student guided by 1 teacher. relationship: 1:n
     * @return [type] [description]
     */
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    /**
     * Relationship between student and cv. 
     * Relationship: 1:1
     * @return [type] [description]
     */
    public function cv()
    {
        return $this->hasOne('App\Cv');
    }

    /**
     * Relationship between users and reports
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    /**
     * Relationship between student and status. 
     * 1:n -> 1 student can be in many status recruitments
     * @return [type] [description]
     */
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }

    public function notifyTeacherAcceptance()
    {
        return $this->hasOne('App\NotifyTeacherAcceptance');
    }
}
