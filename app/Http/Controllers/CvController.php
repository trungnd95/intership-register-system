<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cv;
use Validate;
use Validator;
use Request;
use App\User;
use File;
use Alert;
use View;
use App;
use PDF;

class CvController extends Controller
{
    /**
     * Constructor
     */
    // public function __construct()
    // {
    	// $this->middleware('auth');
    // }

    /**
     * [init description]
     * @return [type] [description]
     */
    public function init()
    {
        return view('templates.students.cv.init');
    }

    /**
     * Function get cv outline view 
     * @param  $id : indentify student
     * @return
     */
    public function view($id)
    {   
        $cv = User::find($id)->load('cv');
        return view('templates.students.cv.view',compact('cv'));
    }   

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create($id)
    {
        return view('templates.students.cv.create',compact('id'));
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store($user_id)
    {
        $validator = Validator::make(Request::all(),[
            'name'              => 'required|min:6',
            'student_code'      => 'required|unique:cvs',
            'class'             => 'required',
            'phone_number'      => 'required|unique:cvs',
            'email'             => 'required|email|unique:cvs',
            'email1'            => 'email|unique:cvs',
            'address'           => 'required',
            'short_selfintro'   => 'required',
            'education'         => 'required',
            'skills'            => 'required',
            'technical'         => 'required',
            'hobbies'           => 'required',

        ],[
            'name.required'      => 'Bạn chưa nhập tên của mình',
            'student_code.required'=> 'Bạn chưa nhập mã sinh viên của mình',
            'student_code.unique'=> 'Mã sinh viên là duy nhất. Bạn có đang dùng msv của ai đó ko???',
            'name.min'           => 'Tên quá ngắn',
            'class.required'     => 'Bạn chưa nhập tên khóa học của mình','email.required'    => 'Bạn chưa nhập email',
            'phone_number.required'=> 'Bạn chưa nhập số điện thoại của mình',
            'phone_number.unique'  => 'Bạn không được sử dụng số điện thoại của người khác',    
            'email.email'       => 'Email không đúng định dạng',
            'email.unique'      => 'Bạn không được sử dụng email của người khác',
            'email1.email'       => 'Email không đúng định dạng',
            'email1.unique'      => 'Bạn không được sử dụng email của người khác',
            'address.required'  => 'Bạn chưa nhập quê quán',
            'short_selfintro.required'   => 'Hãy giới thiệu 1 vài điều ngắn gọn về bản thân',
            'education.required'=> 'Hãy tóm tắt ngắn gọn quá trình học tập. Bắt buộc',
            'skills.required'   => 'Hãy nêu những kĩ năng về chuyên ngành của bạn. Nếu không có thì ghi không có',
            'technical.required'=> 'Nêu các công nghệ mà bạn  đã sử dụng',
            'hobbies.required'  => 'Tóm tắt ngắn gọn về sở thích của cá nhân. Những lúc rảnh rỗi', 
        ]);

        if($validator->fails())
        {   
            Alert::error("Xảy ra lỗi khi tạo hồ sơ. Xem thông báo lỗi và sửa lại")->persistent("Close");
            return back()->withInput()->withErrors($validator);
        }

        $cv = new Cv;
        if(Request::file('image'))
        {
            $image = Request::file('image')->getClientOriginalName();
            $des = base_path().'/public/upload/images/students/';
            Request::file('image')->move($des,Request::file('image')->getClientOriginalName());
            $cv->image = $image;
        }
        $cv->name = Request::get('name');
        $cv->student_code = Request::get('student_code');
        $cv->class = Request::get('class');
        $cv->phone_number = Request::get('phone_number');
        $cv->email  = Request::get('email');
        if(Request::get('email1') != '')
        {
            $cv->email1= Request::get('email1');
        }
        $cv->address= Request::get('address');
        $cv->personal_website = Request::get('personal_website');
        $cv->short_selfintro = Request::get('short_selfintro');
        $cv->education = Request::get('education');
        $cv->skills = Request::get('skills');
        $cv->technical = Request::get('technical');
        $cv->experiences = Request::get('experiences');
        $cv->hobbies = Request::get('hobbies');
        $cv->others = Request::get('others');
        $cv->user_id = $user_id;
        $cv->save();
        Alert::success('Tạo thành công')->persistent("Close");
        return redirect()->route('student.cv.view',$user_id);
    }

    /**
     * Function to get view edit form
     * @param $id: identify student
     */
    public function edit($id)
    {
        $cv = Cv::select('*')->where('user_id','=',$id)->first();
        return view('templates.students.cv.edit',compact('cv','id'));
    }


    /**
     * Function to store data just updated to database
     * @param $id: identify student
     */
    public function update($id)
    {
        $validator = Validator::make(Request::all(),[
            'name'              => 'required|min:6',
            'student_code'      => 'required',
            'class'             => 'required',
            'phone_number'      => 'required',
            'email'             => 'required|email',
            'email1'            => 'email',
            'address'           => 'required',
            'short_selfintro'   => 'required',
            'education'         => 'required',
            'skills'            => 'required',
            'technical'         => 'required',
            'hobbies'           => 'required',

        ],[
           'name.required'      => 'Bạn chưa nhập tên của mình',
           'name.min'           => 'Tên quá ngắn',
           'student_code.required'  => 'Mã sinh viên không được để trống',
           'class.required'     => 'Lớp khóa học không được để trống',
           'phone_number.required'  => 'Số điện thoại là bắt buộc',           
            'email.required'    => 'Bạn chưa nhập email',
            'email.email'       => 'Email không đúng định dạng',
            'email1'            => 'Email chưa đúng định dạng',
            'address.required'  => 'Bạn chưa nhập quê quán',
            'short_selfintro.required'   => 'Hãy giới thiệu 1 vài điều ngắn gọn về bản thân',
            'education.required'=> 'Hãy tóm tắt ngắn gọn quá trình học tập. Bắt buộc',
            'skills.required'   => 'Hãy nêu những kĩ năng về chuyên ngành của bạn. Nếu không có thì ghi không có',
            'technical.required'=> 'Nêu các công nghệ mà bạn  đã sử dụng',
            'hobbies.required'  => 'Tóm tắt ngắn gọn về sở thích của cá nhân. Những lúc rảnh rỗi', 
        ]);
        if($validator->fails())
        {   

            Alert::error("Xảy ra lỗi khi cập nhật. Xem thông báo lỗi và sửa lại")->persistent("Close");
            return back()->withInput()->withErrors($validator);
        }


        $cv = User::find($id)->cv;
        $image = $cv->image;
        if(Request::file('image'))
        {
            if($cv->image != Request::file('image')->getClientOriginalName())
            {
                $old_des =  base_path().'/public/upload/images/students/'.$cv->image;
                File::delete($old_des);
            }
            $image = Request::file('image')->getClientOriginalName();
            $des = base_path().'/public/upload/images/students/';
            Request::file('image')->move($des,Request::file('image')->getClientOriginalName());
        }
        $cv->name = Request::get('name');
        $cv->image = $image;
        $cv->student_code = Request::get('student_code');
        $cv->class = Request::get('class');
        $cv->phone_number = Request::get('phone_number');
        $cv->email  = Request::get('email');
        if(Request::get('email1'))
        {
            $cv->email1 = Request::get('email1');
        }
        $cv->address= Request::get('address');
        $cv->personal_website = Request::get('personal_website');
        $cv->short_selfintro = Request::get('short_selfintro');
        $cv->education = Request::get('education');
        $cv->skills = Request::get('skills');
        $cv->technical = Request::get('technical');
        $cv->experiences = Request::get('experiences');
        $cv->hobbies = Request::get('hobbies');
        $cv->others = Request::get('others');
        $cv->user_id = $id;
        $cv->save();
        Alert::success('Cập nhật thành công')->persistent("Close");
        return back();
    }

    public function export($id)
    {
        $cv = User::find($id)->load('cv');
//        $view = view('templates.students.cv.view',['cv'=>$cv])->render();

        $pdf = PDF::loadView('templates.students.cv.view', ['cv'=>$cv]);
        return $pdf->download('invoice.pdf');
    }   
}
