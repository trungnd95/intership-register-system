<?php

namespace App\Http\Controllers\Auth;

// use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Request;
use Hash;
use Mail;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    
    /**=================================
     * ======Register Student Handle====
     * =================================    
     */
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     * Capture ajax data and store it in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        
        if(Request::ajax())
        {
            $validator =  Validator::make(Request::all(),[
                        'email' => 'unique:users'
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
            $confirmation_code = str_random(10);

            $usernameExist =  User::select('email')->where('user_name','=',$username)->get();
            if(count($usernameExist) != 0)
            {
               return response()->json('Tài khoản đã bị trùng'); 
            }

            $user_exist =  User::select('email')->where('email','=',$email)->get();
            if(count($user_exist) != 0)
            {
               return response()->json('Email đã có người đăng kí'); 
            }

            User::create([
                'user_name'     => $username,
                // 'full_name'     => '',
                'email'         => $email,
                'password'      => Hash::make($password),
                'student_code'  => time(),
                // 'class_name'    => '',
                // 'birth_day'     => '',
                'phone_number'  => time() + 1,
                // 'avatar'        => '',
                'confirmed'     => 0,
                'confirmation_code'=> $confirmation_code,
                // 'teacher_id'    => 1
            ]);

            /**
             * Send email to confirm user 
             */
            $data =  array('confirmation_code'=>$confirmation_code,'email'=>$email,'username'=>$username);
            Mail::send('auth.emails.verify', $data, function($message) use ($data)
            {
                $message->to($data['email'],$data['username'])
                    ->subject('Xác nhận đăng kí hệ thống đăng kí thực tập');
            });


            return response()->json('registered');
        }
    }

    /**
     * Confirm user 
     * @param $confirmation_code : definite user
     * @return 
     */
    public function confirm ($confirmation_code)
    {
       $user = User::where('confirmation_code','=',$confirmation_code)->first();
       if(count($user) != 0)
       {
            $user->update([
                'confirmed'         => 1,
                'confirmation_code' => '',
            ]);
            // $cv = new App\Cv;
            // $cv->user_id = $user->id;
            // $cv->save();

            return redirect()->route('student.index');
        }
        
    }

    /*====================================
     * =====Login Student=================
     * ===================================
     */
    
    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.students.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make(Request::all(),[
            'email'     => 'required|email',
            'password'  => 'required',
        ],[
            'email.required'    => 'Bạn chưa nhập email',
            'email.email'       => 'Email chưa đúng định dạng',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $credentials = [
            'email'     => Request::get('email'),
            'password'  => Request::get('password'),
            'confirmed' => 1,
        ];
        $remember =  Request::get('remember');
        if(\Auth::attempt($credentials,$remember))
        {
            return redirect()->route('student.index')->with(['flash_level'=>'success','flash_message'=>'Đăng nhập thành công']);
        }
        else {
            return back()->withInput()->with(['information_err'=>'Thông tin đăng nhập không chính xác','verify'=>'Hoặc tài khoản chưa được kích hoạt']);
        }


    }

}
