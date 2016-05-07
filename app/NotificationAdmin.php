<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    protected $fillable = [
        'id','user_id','company_id','message','seen'
    ];
}
