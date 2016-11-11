<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Teacher;
use Validator;
use File;
use Request;
use App\StudentNotification;
use App\TeacherNotification;
use App\Events\NotifyTeacher;
use App\Events\NotifyStudent;
use Alert;
use Hash;

class UserController extends Controller
{
    /**
     * Home page of student panel 
     * @return 
     */
    public function index()
    {
    	return view('templates.students.index');
    }

    /**
     * Display student profile
     * @param  $id: identify student
     * @return 
     */
    public function seeProfile($id)
    {
        $user =  User::select('*')->where('id','=',$id)->first();
        // dd($user);
        return view('templates.students.profile.profile',compact('user'));
    }

    /**
     * Function to show form to update profile student
     * @param  $id - id of student in session 
     * @return 
     */
    public function update($id)
    {	
    	$user = User::select('*')->where('id','=',$id)->first();
    	return view('templates.students.profile.update-info',compact('user'));
    }

    /**
     * Store data just updated
     * @param  $id - id of student in session 
     * @return 
     */
    public function store($id)
    {
        
        $validator = Validator::make(Request::all(),[
            'username'      => 'required',
            'full_name'     => 'required|min:6',
            'email'         => 'required|email',
            'student_code'  => 'required',
            'class_name'    => 'required',
            'phone_number'  => 'required|min:9|max:12',
//            'teacher_id'    => 'required',
            'birth_day'     => 'required',

        ],[
            'username.required' => 'Tên đăng nhập là trường bắt buộc',
            'full_name.required'=> 'Bắt buộc',
            'email.required'    => 'Bắt buộc',
            'email.email'       => 'Email không đúng định dạng',
            'student_code.required' => 'Bạn chưa nhập mã sinh viên',
            'class_name.required'   => 'Bạn chưa nhập tên lớp',
            'phone_number.required' => 'Bạn chưa nhập số điện thoại liên lạc',
            'phone_number.min'      => 'Số điện thoại tối thiểu là 9 chữ số',
            'phone_number.max'      => 'Số điện thoại quá dài',
//            'teacher_id.required'   => 'Bạn chưa chọn giảng viên hướng dẫn',
            'birth_day.required'    => 'Bắt buộc'
        ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        //else
        $user = User::find($id);
        $avatar = $user->avatar;
        
        if(Request::file('avatar') )
        {   
            $avatar = Request::file('avatar')->getClientOriginalName();
            if($user->avatar != $avatar) {
                    $old_des =  base_path().'/public/upload/images/students/'.$user->avatar;
                    File::delete($old_des);
            }
            //Upload image
            //
            $des = base_path().'/public/upload/images/students/';
            if(isset($avatar))
            {
                Request::file('avatar')->move($des,$avatar);
            }

            
        }
        $user->update([
            'user_name'     => Request::get('username'),
            'full_name'     => Request::get('full_name'),
            'email'         => Request::get('email'),
            'student_code'  => Request::get('student_code'),
            'class_name'    => Request::get('class_name'),
            'birth_day'     => Request::get('birth_day'),
            'phone_number'  => Request::get('phone_number'),
            'avatar'        => $avatar,
//            'teacher_id'    => Request::get('teacher_id'),
            'teacher_acceptance'=> 'pending'

        ]);
//        $user->save();
//        $student_name = (($user->full_name) != ' ') ? $user->full_name : $user->user_name;
//        $notifyTeacher =  new TeacherNotification;
//        $notifyTeacher->teacher_id =  $user->teacher_id;
//        $notifyTeacher->user_id =  $user->id;
//        $notifyTeacher->message = 'Sinh viên <a href="'.route('teacher.student.cvView',[$user->id]).'" style="color:#01a4e1" target="_blank">'.$student_name. '</a> vừa lựa chọn thầy/cô làm người hướng dẫn đợt thực tập hè này';
//        $notifyTeacher->seen = 0;
//        $notifyTeacher->save();
//        event(new NotifyTeacher($notifyTeacher));
        Alert::success('Cập nhật thành công')->persistent('Đóng');
        return redirect()->route('student.seeProfile',[$id]);
    }

    /**
     * List all student in admin panel
     * @param $id- identify teacher
     * @return 
     */
    public function listStudents($teacher_id)
    {
        $allStudents = User::with(['cv'])->where('teacher_id','=',$teacher_id)->get();
        return view('templates.teachers.listStudents.allStudents',compact('allStudents'));
    }

    /**
     * See notifications 
     * @return [type] [description]
     */
    public function notifications($id)
    {   
        $user = User::findOrFail($id);
        $notificationsStudent =  StudentNotification::where('user_id','=',$id)->orderBy('id','DESC')->paginate(5);
        $count = 0 ;
        foreach($notificationsStudent as $notify)
        {
            if($notify->seen == 0)
            {   
                $count ++;
                $notify->seen = 1;
                $notify->save();
            }
        }
        return view('templates.students.notifications.notifications',compact('user','notificationsStudent','count'));            
    }

    /**
     * [deleteNotify description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function deleteNotify($user_id)
    {
        if(Request::ajax())
        {
            $noti_id =  Request::get('noti_id');
            $student_noti = StudentNotification::findOrFail($noti_id);
            $student_noti->delete();
            return response()->json('ok');
        }

    }



    /**
     * Function list and manage all students in admin
     * @return view 
     */
    public function manageStudents()
    {
        $students = User::with(['statuses','statuses.company','teacher','cv'])->where('confirmed','=',1)->get();
        return view('templates.admins.students.list',compact('students'));
    }

    /**
     * Change  teacher acceptance status
     */
//    public function teacherAcceptance($teacher_id,$noti_id)
//    {
//        if(Request::ajax())
//        {
//            $user_id =  Request::get('user_id');
//            $acceptance = Request::get('acceptance');
//            $user = User::findOrFail($user_id);
//            $user->teacher_acceptance  =  $acceptance;
//            $user->save();
//            $teacher =  Teacher::findOrFail($user->teacher_id);
//            if($acceptance ==  'accepted')
//            {
//                $message = 'Giảng viên '.$teacher->full_name. ' đã chấp nhận hướng dẫn bạn làm báo cáo thực tập. Hãy chủ động liên hệ';
//            }
//            else {
//                $message = 'Giảng viên '.$teacher->full_name. ' không chấp nhận hướng dẫn bạn làm báo cáo thực tập. Bạn hãy đăng kí thầy cô khác';
//            }
//            $notifyStudent = new StudentNotification ;
//            $notifyStudent->user_id = $user_id;
//            $notifyStudent->message = $message;
//            $notifyStudent->seen =  0;
//            $notifyStudent->save();
//            event(new NotifyStudent($notifyStudent));
//            return response()->json('ok');
//        }
//    }

    /**
     * Function to save teacher just allocated for student
     */
    public function allocateTeacher()
    {
        if(Request::ajax())
        {
            $teacher_id = Request::get('teacher_id');
            $student_id = Request::get('student_id');
            $student = User::findOrFail($student_id);
            if(count($student) > 0)
            {
                $student->teacher_id = $teacher_id;
            }

            $student->save();
            $teacher = Teacher::findOrFail($teacher_id);

            //Notification for teacher
            // $student_name = ($student->full_name != null) ? $student->full_name : $student->user_name;
            // $notificationAdmin = new TeacherNotification;
            // $notificationAdmin->teacher_id =  $teacher_id;
            // $notificationAdmin->user_id =  $student_id;
//            $notificationAdmin->message = 'Sinh viên <a href="'.route('teacher.student.cvView',[$user->id]).'" style="color:#01a4e1" target="_blank">'.$student_name. '</a> vừa lựa chọn thầy/cô làm người hướng dẫn đợt thực tập hè này';
            // $notificationAdmin->message = 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="'.route('teacher.student.cvView',[$student_id]).'" style="color:#01a4e1" target="_blank">'.$student_name.'</a> trong đợt thực tập hè này';
            // $notificationAdmin->seen = 0;
            // $notificationAdmin->save();
            // event(new NotifyTeacher($notificationAdmin));

            //Notification for student
                // $notifyStudent = new StudentNotification ;
                // $notifyStudent->user_id = $student_id;
                // $notifyStudent->message = 'Thông báo: Thầy '.$teacher->full_name.' sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. Thân!';
                // $notifyStudent->seen =  0;
                // $notifyStudent->save();
                // event(new NotifyStudent($notifyStudent));
            return response()->json(['teacher'=>$teacher->full_name,'student'=>$student_id]);
        }
    }

    /**
     * [viewChangePassword description]
     * @return [type] [description]
     */
    public function viewChangePassword($id)
    {
        return view('templates.students.changePassword.view');
    }

    /**
     * [postChangePassword description]
     * @return [type] [description]
     */
    public function postChangePassword($id)
    {
        $user = User::findOrFail($id);
        $new_password = Request::get('new_password');
        $user->password = Hash::make($new_password);
        $user->save();
        Alert::success('Đã đổi mật khẩu')->persistent('Đóng');
        return redirect()->route('student.index');
    }

    /**
     * [checkOldPassword description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function checkOldPassword($id)
    {
        if(Request::ajax())
        {
            $id = Request::get('id');
            // dd(Request::get('val'));
            $val = Request::get('val');
            $user = User::findOrFail($id);
            
            if(Hash::check($val, $user->password))
            {
                return response()->json('ok');
            }else {
                return response()->json('Mật khẩu cũ không đúng');
            }
        }
    }
}
