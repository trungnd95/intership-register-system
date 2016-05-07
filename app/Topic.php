<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title' , 'short_des' ,'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relationship between topic and user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relationship between topic and report
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
