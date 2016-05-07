<?php

namespace App\Http\Controllers\TeacherAuth;

// use Illuminate\Http\Request;
use App\Teacher;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Request;
use Hash;
use Mail;
use Auth;

class TeacherAuthController extends Controller {
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $guard = 'teachers';
	protected $redirectAfterLogout = '/giang-vien/dang-nhap';
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->teachers = auth()->guard('teachers');
	}
	/**
	 * Function to validate and store data registered
	 * @return [type] [description]
	 */
    public function postRegister()
    {
    	if(Request::ajax())
        {
            $validator =  Validator::make(Request::all(),[
                        'email' => 'unique:teachers'
                    ],[
                        'email.unique'  => 'Email này đã có người đăng kí'
                    ]);
            if($validator->fails())
            {   
                return response()->json($validator->messages(),200);
            }
            $token      = Request::get('_token'); 
            $username   = Request::get('username');
            $email      = Request::get('email');
            $email      .= '@vnu.edu.vn'; 
            $password   = Request::get('password');
            $confirmation_code = str_random(8);
            $teacher_exist =  Teacher::select('*')->where('email','=',$email)->get();
            if(count($teacher_exist) != 0)
            {
               return response()->json('Email đã có người đăng kí'); 
            }


            Teacher::create([
                'username'     => $username,
                'email'         => $email,
                'password'      => Hash::make($password),
                'confirmed'     => 0,
                'phone_number'	=> time(),
                'confirmation_code'=> $confirmation_code
            ]);

            /**
             * Send email to confirm user 
             */
            $data =  array('confirmation_code'=>$confirmation_code,'email'=>$email,'username'=>$username);
            Mail::send('auth.emails.verify_teacher', $data, function($message) use ($data)
            {
                $message->to($data['email'],$data['username'])
                    ->subject('Xác nhận đăng kí hệ thống đăng kí thực tập');
            });

            return response()->json('registered');
        }
    }

    /**
     * Confirm teacher registered. Set confirmed = true
     * @return [type] [description]
     */
    public function confirmTeacher($confirmation_code)
    {
    	$teacher = Teacher::where('confirmation_code','=',$confirmation_code)->first();
       if(count($teacher) != 0)
       {
            $teacher->update([
                'confirmed'         => 1,
                'confirmation_code' => '',
            ]);
            return redirect('/giang-vien/dang-nhap');
        }
        //else {
       //      return redirect()->route('')
       // }
    }
    /**
     * Function to get form login
     * @return [type] [description]
     */
    public function getLogin()
    {
    	return view('auth.teachers.login');
    }

    /**
     * Function to verify information access
     * @return [type] [description]
     */
    public function postLogin()
    {
    	$validator = Validator::make(Request::all(),[
    		'username' => 'required',
    		'password' => 'required'
    	],[
    		'username.required' => 'Tên đăng nhập không được trống',
    		'password.required' => 'Chưa nhập mật khẩu'
    	]);
    	//If information is not validated
    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	//Else
    	$credentials =  [
    		'username' => Request::get('username'),
    		'password' => Request::get('password'),
    		'confirmed'=> 1
    	];
    	$remember =  Request::get('remember');
    	if($this->teachers->attempt($credentials,$remember))
    	{
    		return redirect('/giang-vien');
    	}
    	else {
    		return back()->withInput()->with(['information_err'=> 'Thông tin đăng nhập không chính xác','verify'=> 'Hoặc tài khoản chưa được xác nhận']);
    	}

    }

    /**
     * Logout teacher
     * @return [type] [description]
     */
    // public function getLogout()
    // {
    	// $this->teachers->logout();
    	// return redirect('/giang-vien/login');
    // }
}