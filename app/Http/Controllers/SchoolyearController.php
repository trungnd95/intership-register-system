<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Schoolyear;
use Request;
use Validator;
use Alert;

class SchoolyearController extends Controller
{	
	/**
	 * Constructor
	 */
    public function __construct()
    {
    	$this->middleware('admins');
    }

    /**
     * Function to list all school year
     * @return view index
     */
    public function index()
    {
    	$schoolyears = Schoolyear::all();
    	return view('templates.admins.schoolyears.index',compact('schoolyears'));
    }

    /**
     * [add description]
     */
    public function add()
    {
        if(Request::ajax())
        {
            $stt = Request::get('stt');
            $full_name = Request::get('full_name');
            $short_name = Request::get('short_name');
            $schoolyear = new Schoolyear;
            $schoolyear->full_name = $full_name;
            $schoolyear->short_name = $short_name;
            $schoolyear->save();
            $call_view = view('templates.admins.schoolyears.ajax-render',['schoolyear'=>$schoolyear,'stt'=>$stt])->render();
            return response()->json($call_view);

        }
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        if(Request::ajax())
        {
            $column = Request::get('column');
            $content =  Request::get('editval');
            $id = Request::get('id');
            $schoolyear = Schoolyear::findOrFail($id);
            $schoolyear->update([
                $column => $content,
            ]);

            $schoolyear->save();
            return response()->json($content);
        }
    }

    /**
     * [delete description]
     * @return [type] [description]
     */
    public function delete($id)
    {
        if(Request::ajax())
        {
            $schoolyear_id = Request::get('schoolyear_id');
            $schoolyear = Schoolyear::findOrFail($schoolyear_id);
            $schoolyear->delete();
            return response()->json($schoolyear_id);
        }
    }
}   
