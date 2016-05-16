<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Request;
use Validator;
use Mail;
use Hash;
use App\Teacher;
use Validate;
use Alert;
use File;
use App\TeacherNotification;

class TeacherController extends Controller
{
	/**
	 * Constructors
	 */
	// public function __construct()
 //    {
 //        $this->middleware('teachers');
 //    }

    /**
     * Home page teacher
     * @return 
     */
    public function index()
    {
    		return view('templates.teachers.index');
    }
	
    /**
     * View detail profile of teacher
     * @param  $id: identify teacher
     * @return 
     */
    public function getProfile($id)
    {
        $teacher =  Teacher::find($id);
        return view('templates.teachers.profile.view',compact('teacher'));   
    }

    /**
     * View to edit profile
     * @param $id - identify teacher
     * @return 
     */
    public function edit($id)
    {
        $teacher =  Teacher::find($id);
        return view('templates.teachers.profile.edit',compact('teacher'));
    }

    /**
     * function to store data to datbase
     * @param $id - identify teacher
     * @return 
     */
    public function update($id)
    {
        $validator =  Validator::make(Request::all(),[
            'username'      => 'required|min:3',
            'full_name'     => 'required',
            'email'         => 'required|email',
            'phone_number'  => 'required|min:9|max:12',
            'degree'        => 'required',
            'strong_point'  => 'required|min:10'

        ],[
            'username.required' => 'Tên đăng nhập là trường bắt buộc',
            'username.min'      => 'Tên đăng nhập quá ngắn',
            'full_name.required'=> 'Chưa nhập tên đầy đủ ',
            'email.required'    => 'Chưa nhập tên email',
            'email.email'       => 'Email chưa đúng định dạng',
            'phone_number.required'=> 'Chưa nhập số điện thoại',
            'phone_number.min'     => 'Số điện thoại quá ngắn',
            'degree.required'      => 'Học hàm , học vị là trường bắt buộc',
            'strong_point.required'=> 'Hãy nhập điểm mạnh và hướng nghiên cứu của mình',
            'strong_point.min'     => 'Quá ngắn'    
        ]);
        if($validator->fails())
        {   
            return back()->withInput()->withErrors($validator);
        }
        if(count(Teacher::where('username','==',Request::get('username'))->where('id','!=',$id)->get()) > 0)
        {
            $validator->errors()->add('username', 'Tên đăng nhập đã có người sử dụng');
            return back()->withInput()->withErrors($validator);
        }

        if(count(Teacher::where('email','==',Request::get('email'))->where('id','!=',$id)->get()) > 0)
        {
            $validator->errors()->add('email', 'Email đã có người sử dụng');
            return back()->withInput()->withErrors($validator);
        }

        if(count(Teacher::where('phone_number','==',Request::get('phone_number'))->where('id','!=',$id)->get()) > 0)
        {
            $validator->errors()->add('phone_number', 'Số điện thoại đã có người sử dụng');
            return back()->withInput()->withErrors($validator);
        }

        /**
         * Upload avatar image
         */
        $teacher = Teacher::find($id);
        $avatar = $teacher->avatar;
        
        if(Request::file('avatar') )
        {   
            $avatar = Request::file('avatar')->getClientOriginalName();
            if($teacher->avatar != $avatar) {
                    $old_des =  base_path().'/public/upload/images/teachers/'.$teacher->avatar;
                    File::delete($old_des);
            }
            //Upload image
            $des = base_path().'/public/upload/images/teachers/';
            if(isset($avatar))
            {
                Request::file('avatar')->move($des,$avatar);
            }

            
        }
        
        $teacher->username = Request::get('username');
        $teacher->full_name = Request::get('full_name');
        $teacher->email    = Request::get('email');
        $teacher->phone_number = Request::get('phone_number');
        $teacher->degree = Request::get('degree');
        $teacher->strong_point = Request::get('strong_point');
        $teacher->avatar  = $avatar;
        $teacher->save();
        Alert::success('Cập nhật thông tin thành công')->persistent('Đóng');
        return redirect()->route('teacher.pfofile.detail',$id);
    }

    /**
     * See notifications 
     * @return [type] [description]
     */
    public function notifications($teacher_id)
    {   
        $teacher = Teacher::findOrFail($teacher_id);
        $notifyTeacher =  TeacherNotification::where('teacher_id','=',$teacher_id)->orderBy('id', 'desc')->paginate(10);
        $count = 0 ;
        foreach($notifyTeacher as $notify)
        {
            if($notify->seen == 0)
            {   
                $count ++;
                $notify->seen = 1;
                $notify->save();
            }
        }
        return view('templates.teachers.notifications.notifications',compact('teacher','notifyTeacher','count'));            
    }

    public function deleteNotify($teacher_id)
    {
        if(Request::ajax())
        {
            $noti_id =  Request::get('noti_id');
            $teacher_noti = TeacherNotification::findOrFail($noti_id);
            $teacher_noti->delete();
            return response()->json('ok');
        }
    }

    /**
     * [teacherList description]
     * @return [type] [description]
     */
    public function teacherList()
    {
        $teachers = Teacher::all();
        return view('templates.students.profile.teacherList',compact('teachers'));
    }

    /**
     * [viewChangePassword description]
     * @return [type] [description]
     */
    public function viewChangePassword($id)
    {
        return view('templates.teachers.changePassword.view');
    }

    /**
     * [postChangePassword description]
     * @return [type] [description]
     */
    public function postChangePassword($id)
    {
        $teacher = Teacher::findOrFail($id);
        $new_password = Request::get('new_password');
        $teacher->password = Hash::make($new_password);
        $teacher->save();
        Alert::success('Đã đổi mật khẩu')->persistent('Đóng');
        return redirect()->route('teacher.index');
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
            $teacher = Teacher::findOrFail($id);
            
            if(Hash::check($val, $teacher->password))
            {
                return response()->json('ok');
            }else {
                return response()->json('Mật khẩu cũ không đúng');
            }
        }
    }
}
