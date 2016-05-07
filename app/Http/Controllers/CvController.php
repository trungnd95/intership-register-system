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
            'email'             => 'required|email',
            'address'           => 'required',
            'short_selfintro'   => 'required',
            'education'         => 'required',
            'skills'            => 'required',
            'technical'         => 'required',
            'hobbies'           => 'required',

        ],[
           'name.required'      => 'Bạn chưa nhập tên của mình',
           'name.min'           => 'Tên quá ngắn',    
            'email.required'    => 'Bạn chưa nhập email',
            'email.email'       => 'Email không đúng định dạng',
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
        $cv->email  = Request::get('email');
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
}
