<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','address','contact','recruitment_amount','description','services'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * relationship between company and status . 1:n
     */
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }
}
