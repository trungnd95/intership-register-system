<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\AdminConfiguration;
use Request;
use Alert;
use App\User;
use App\Teacher;
use App\StudentNotification;
use App\TeacherNotification;
use App\Events\NotifyTeacher;
use App\Events\NotifyStudent;
class ConfigurationController extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$configuration = AdminConfiguration::first();
    	if(count($configuration) == 0)
    	{
    		AdminConfiguration::create([
    		]);
    	}
    	return view('templates.admins.configurations.index',compact('configuration'));
    }

    /**
     * [save description]
     * @return [type] [description]
     */
    public function save()
    {
    	$max_register =  Request::get('max_register');
    	$send_notify_student  = Request::get('send-notify-student');

    	$send_notify_teacher  = Request::get('send-notify-teacher');
    	$time_start =  Request::get('time_start');
    	$time_end =  Request::get('time_end');

    	$configuration  = AdminConfiguration::first();
    	$configuration->max_register = $max_register;
    	if($send_notify_student == null)
    	{
    		$configuration->send_notify_student = 0;
    	} 
    	else {
    		// dd($send_notify_student);
    		$configuration->send_notify_student = $send_notify_student;	
    		$users = User::select('id','teacher_id')->with(['teacher','statuses.company'])->where('confirmed','=',1)->get();
    		// return $users;
    		//Send notification about teacher who instruct 
    		foreach($users as $user)
    		{
    			$notifyStudent = new StudentNotification ;
                $notifyStudent->user_id = $user->id;
                $notifyStudent->message = 'Thông báo: Thầy '.$user->teacher->full_name.' sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. <br/> Email:'.$user->teacher->email.'Thân!';
                $notifyStudent->seen =  0;
                $notifyStudent->save();
                event(new NotifyStudent($notifyStudent));
                //Send notification about company status you registered
                foreach($user->statuses as $status)
                {
                	$notifyStudent = new StudentNotification;
	                $notifyStudent->user_id = $user->id;
	                if($status->acceptance == 'success')
	                {
	                    $notifyStudent->message = 'Công ty '.$status->company->name.' đã chấp nhận bạn vào thực tập tại công ty';
	                }else {
	                    $notifyStudent->message = 'Công ty '.$status->company->name.' không chấp nhận bạn vào thực tập tại công ty';
	                }
	                $notifyStudent->seen = 0;
	                $notifyStudent->save();
	                event(new NotifyStudent($notifyStudent));
                }
    		}
    	

    	}
    	
    	if($send_notify_teacher == null)
    	{
    		$configuration->send_notify_teacher = 0;
    	} 
    	else {
    		$configuration->send_notify_teacher = $send_notify_teacher;	
    		$teachers = Teacher::with(['users'])->where('confirmed','=',1)->get();
    		foreach($teachers as $teacher)
    		{
    			foreach($teacher->users as $student)
    			{
    				$student_name = ($student->full_name != null) ? $student->full_name : $student->user_name;
	            	$notificationAdmin = new TeacherNotification;
	            	$notificationAdmin->teacher_id =  $teacher->id;
	            	$notificationAdmin->user_id =  $student->id;
	           		$notificationAdmin->message = 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="'.route('teacher.student.cvView',[$student->id]).'" style="color:#01a4e1" target="_blank">'.$student_name.'</a> trong đợt thực tập hè này';
	            	$notificationAdmin->seen = 0;
	            	$notificationAdmin->save();
	            	event(new NotifyTeacher($notificationAdmin));
    			}
    			
    		}
    	}

    	$configuration->time_start = $time_start;
    	$configuration->time_end = $time_end;
    	$configuration->save();
    	Alert::success('Cấu hình thành công')->persistent('Đóng');
    	return back();
    }
}
