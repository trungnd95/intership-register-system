<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Request;
use App\Feedback;
use Mail;
use Alert;

class FeedbackController extends Controller
{
	/**
	 * [__construct description]
	 */
    public function __construct()
    {

    }

    /**
     * [getForm description]
     * @return [type] [description]
     */
    public function getForm()
    {
    	
    	return view('templates.feedbacks.form');
    }

    /**
     * Save feedback to database and send email to admin
     * @return [type] [description]
     */
    public function saveForm()
    {
    	$email = Request::input('email');
    	$content = Request::get('content');
    	$feedback = new Feedback;
    	$feedback->email =  $email;
    	$feedback->content =  $content;
    	$feedback->save();
    	//Send email 
    	$data = ['email'=> $email,'content'=> $content];
    	Mail::send('templates.feedbacks.email',$data,function($message) use ($data) {
    		$message->from($data['email'],'Guest Feedback');
    		$message->to('ndt8895@gmail.com','Admin')->subject('Feedback');
    	});

    	Alert::success("Phản hồi của bạn đã được hệ thống lưu lại. Cám ơn bạn đã đóng góp để hệ thống hoàn thiện hơn !","Đã gửi")->persistent('Đóng');
    	if(Auth::guard('teachers')->getUser() == null)
    	{
    		return redirect()->route('student.index');	
    	}else {
    		return redirect()->route('teacher.index');	
    	}
    	
    }

    /**
     * List all feeback from user
     * @return [type] [description]
     */
    public function index()
    {
    	$feedbacks = Feedback::paginate(10);
    	return view('templates.admins.feedbacks.index',compact('feedbacks'));
    }

    public function update($id)
    {
        if(Request::ajax())
        {
            $id = Request::get('id');
            $value = Request::get('value');
            $feedback = Feedback::findOrFail($id);
            $feedback->reply_status = $value;
            $feedback->save();
            return response()->json('ok');
        }
    }

    /**
     * [delete description]
     * @return [type] [description]
     */
    public function delete()
    {
        if(Request::ajax())
        {
            $id = Request::get('id');
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return response()->json('ok');
        }
    }
}
