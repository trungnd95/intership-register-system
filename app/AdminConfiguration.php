<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminConfiguration extends Model
{
 	protected $fillable = [ 'time_start','time_end' , 'max_register' ,'send_notify_student' ,'send_notify_teacher' ];
}
