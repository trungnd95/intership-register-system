<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\RegisterTime;
use Request;
class TimeController extends Controller
{
    /**
     *
     */
    public function index()
    {

        $time = RegisterTime::first();
        if(count($time) == 0)
        {
        	$time = new RegisterTime;
        	$time->save();
        }
        return view('templates.admins.times.index',compact('time'));
    }

    /**
     * [save description]
     * @return [type] [description]
     */
    public function save()
    {
    	if(Request::ajax())
    	{
    		$time_start = Request::get('time_start');
    		$time_end = Request::get('time_end');
    		// dd($time_start);
    		$time = RegisterTime::first();
    		if($time_start != null)
    		{
    			$time->time_start =  $time_start;	
    		}
    		if($time_end != null)
    		{
    			$time->time_end = $time_end;
    		}
    		$time->save();
    		return response()->json('ok');
    	}
    }
}
