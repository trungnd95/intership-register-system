<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Request;
use App\Notification;

class NotificationController extends Controller
{
	/**
	 * [list description]
	 * @return [type] [description]
	 */
  	public function index()
  	{
  		$notifications =  Notification::all();
  		return view('templates.admins.notifications1.list',compact('notifications'));
  	}

  	/**
  	 * [add description]
  	 */
  	public function add()
  	{
  		if(Request::ajax())
        {
            $stt = Request::get('stt');
            $content = Request::get('content');
            // $short_name = Request::get('short_name');
            $notification = new Notification;
            $notification->content = $content;
            // $notification->short_name = $short_name;
            $notification->save();
            $call_view = view('templates.admins.notifications1.ajax-render',['notify'=>$notification,'stt'=>$stt])->render();
            return response()->json($call_view);

        }
  	}
  	/**
  	 * [edit description]
  	 * @return [type] [description]
  	 */
  	public function edit($id)
  	{
  		if(Request::ajax())
        {
            $column = Request::get('column');
            $content =  Request::get('editval');
            $id = Request::get('id');
            $notification = Notification::findOrFail($id);
            $notification->update([
                $column => $content,
            ]);

            $notification->save();
            return response()->json($content);
        }

  	}

  	/**
  	 * [delete description]
  	 * @param  [type] $id [description]
  	 * @return [type]     [description]
  	 */
  	public function delete($id)
  	{
  		if(Request::ajax())
  		{
  			$id =  Request::get('notification_id');
  			$notify = Notification::findOrFail($id);
  			$notify->delete();
  			return response()->json($id);
  		}
  	}
}
