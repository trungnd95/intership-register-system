<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','company_id','acceptance','choosen','contacted'
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
    
    /**
     * relationship between student and status
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * relationship between company and status
     */
    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
