<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title','content','user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * relationship between topic and report
     */
    public function topic()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relationship between report and comment
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
