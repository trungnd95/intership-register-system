<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title','slug','content','short_des','schoolyear_id','created_at','update_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * Relationship 
     */
    public function schoolyear()
    {
        return $this->belongsTo('App\Schoolyear');
    }
}
