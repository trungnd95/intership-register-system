<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','username', 'email', 'password','full_name','degree','phone_number','confirmed','confirmation_code'
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
     * Relation between teacher and students. 
     * 1 teacher can guide many students. relationship: 1:n
     * @return [type] [description]
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Relation between notify techer acceptance table
     * One teacher can instruct many student
     */
    public function notifyTeacherAcceptance()
    {
        return $this->hasMany('App\NotifyTeacherAcceptance');
    }
    
}
