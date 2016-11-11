<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Report;
use Request;
use Validator;
use Alert;
use Auth;
use App\Comment;
use App\User;
use App\Teacher;
use App\Cv;
class ReportController extends Controller
{
	/**
	 * Constructor 
	 */
 	// public function __construct()
 	// {
 		// $this->middleware('auth');
 	// }

 	/**
 	 * Function to list all reports of student
 	 * $user_id : identify student
 	 * @return 
 	 */
 	public function index($user_id)
 	{	
 		$student = User::findOrFail($user_id);
 		$reports = Report::with('comments')->where('user_id','=',$user_id)->get();
 		// return $reports;
 		return view('templates.students.reports.index',compact('reports','student'));
 	}

 	/**
 	 * Function get view to add report
 	 * @param $user_id : identify student
 	 */
 	public function add($user_id)
 	{
 		return view('templates.students.reports.add');
 	}

 	/**
 	 * Function store all data just added to database
 	 * @param  $user_id : identify student
 	 */
 	public function store($user_id)
 	{
 		$validator = Validator::make(Request::all(),[
 			'title_report'		=> 'required',
 			'content_report'	=> 'required|min:20'
 		],[
 			'title.required'			=> 'Bạn chưa nhập tiêu đề bài báo cáo',
 			'content_report.required'	=> 'Bạn chưa nhập nội dung báo cáo',
 			'content_report.min'		=> 'Dường như không phải là 1 bài báo cáo'
 		]);

 		if($validator->fails())
 		{
 			return back()->withInput()->withErrors($validator);
 		}

 		Report::create([
 			'title'		=> Request::get('title_report'),
 			'content'	=> Request::get('content_report'),
 			'user_id'	=> $user_id
 		]);
 		Alert::success('Tạo báo cáo thành công')->persistent('Đóng');
 		return redirect()->route('student.report.index',[$user_id]);	
 	}

 	/**
 	 * Save comment to database
 	 * @return [type] [description]
 	 */
 	public function comment($report_id){
 		if(Request::ajax())
 		{

 			$content_comment = Request::get('comment');
 			$guard = Request::get('guard');
 			$guard_id = Request::get('guard_id');
 			if($guard == 'teachers')
 			{	
 				// console.log('teachers');
 				$teacher =  Teacher::find($guard_id);
 				$username = $teacher->username;
 				$role = 'teacher';
 				$avatar_src =  asset('/images/tutor_login_icon.png');
 			}
 			else {
 				$student = User::find($guard_id);
 				$username = $student->user_name;
 				$role = 'student';
 				$cv = Cv::where('user_id','=',$guard_id)->first();
 				if(count($cv) > 0 && $cv->image != '')
 				{
 					$avatar_src =  asset('/upload/images/students/'.$cv->image);	
 				}else {
 					$avatar_src =  asset('/images/Student-icon.png');	
 				}
 				
 			}
 			$comment = new Comment;
 			$comment->username = $username;
 			$comment->comment = $content_comment;
 			$comment->avatar_src = $avatar_src;
 			$comment->role = $role;
 			$comment->report_id = $report_id;
 			$comment->save();
 			pusher()->trigger('comments','comment',['comment'=>$comment]);
 			return response()->json('ok');
 		}
 	}
}
