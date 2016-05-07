<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','image','email','address','personal_website','short_selfintro','education',
        'skills','technical','experiences','hobbies','others','user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * relationship
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
