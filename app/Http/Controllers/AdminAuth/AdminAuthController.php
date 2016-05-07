<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
// use Request;
use Hash;
use Mail;
use Auth;
class AdminAuthController extends Controller {

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $guard = 'admins';
    protected $redirectAfterLogout = '/admin/login';
    public function __construct()
    {
        $this->admins = auth()->guard('admins');
    }
    /**
	 * Function get view login form
	 * @return [type] [description]
	 */
    

    public function getLogin()
    {	
    	return view('auth.admins.getLogin');
    }

    public function postLogin(Request $request)
    {
    	
    	$validator =  Validator::make($request->all(),[
    			'username' => 'required',
    			'password' => 'required'
    	],[
    			'username.required' => 'Chưa nhập tên đăng nhập',
    			'password.required' => 'Chưa nhập mật khẩu'
    	]);

    	//If information was not validated
    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	//Else 
    	$credentials = [
    		'username' => $request->get('username'),
    		'password' => $request->get('password')
    	];
    	if($this->admins->attempt($credentials))
    	{
    		return redirect()-> route('admin.index');
    	}
    	else {
    		return back()->withInput()->withErrors(['Thông tin đăng nhập không chính xác']);
    	}

    }

}