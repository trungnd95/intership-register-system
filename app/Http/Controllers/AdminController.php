<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Hash;
use Request;
use Alert;
use App\NotificationAdmin;
use App\Status;
class AdminController extends Controller
{
	/**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('admins'); 
    }

    /**
     *  Home page admin panel
     */
    public function index()
    {
        return view('templates.admins.index');
    }

    /**
     * [editNotify description]
     * @return [type] [description]
     */
    public function editNotify()
    {
        if(Request::ajax())
        {
            $data = Request::get('data');
            for($i = 0 ; $i < count($data); $i ++)
            {
                $notificationAdmin = NotificationAdmin::findOrFail($data[$i]);
                $notificationAdmin->seen = 1;
                $notificationAdmin->save();
            }

            return response()->json('ok');
        }

    }

    /**
     * [listNotify description]
     * @return [type] [description]
     */
    public function listNotify()
    {
        $all_Notify = NotificationAdmin::orderBy('id','DESC')->get();
        return view('templates.admins.notifications.list',compact('all_Notify'));
    }

    /**
     * [contacted description]
     * @return [type] [description]
     */
    public function contacted()
    {
        if(Request::ajax())
        {
            $column = Request::get('column');
            $content = Request::get('editval');
            $user_id = Request::get('user_id');
            $company_id = Request::get('company_id');
            $status = Status::where('user_id','=',$user_id)->where('company_id','=',$company_id)->first();
            $status->update([
                $column => $content,
            ]);

            return response()->json($content);
        }
    }

    public function notifyDetail($id)
    {
        $notificationAdmin = NotificationAdmin::findOrFail($id);
        return view('templates.admins.notifications.detail',compact('notificationAdmin'));

    }
    
}
