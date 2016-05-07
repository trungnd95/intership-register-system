<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use Auth;
use App\Schoolyear;
use Validator;
use Request;
use Alert;
class NewsController extends Controller
{	
	/**
	 * function to list all record in news table
	 * @return [type] [description]
	 */
    public function index()
    {   
        $news  = News::with('schoolyear')->paginate(10);

        if(Auth::guard('teachers')->getUser() != null)
        {
            return view('templates.teachers.news.list', compact('news'));        
        }

        if(Auth::guard('admins')->getUser() != null)
        {
            return view('templates.admins.news.list',compact('news'));
        }

        return view('templates.students.news.list', compact('news'));
    }

    /**
     * View detail new
     * @param  $slug - identify this new
     * @return 
     */
    public function detail($slug)
    {
        $new = News::where('slug','=',$slug)->first();
        $relateds = News::select('*')->whereNotIn('slug',[$slug])->take(5)->get();
        if(Auth::guard('teachers')->getUser() != null)
        {
            return view('templates.teachers.news.detail',compact('new','relateds'));
        }
        return view('templates.students.news.detail',compact('new','relateds'));
    }

    /**
     * Add new article
     */
    public function add()
    {
        $schoolyears = Schoolyear::all();
        return view('templates.admins.news.add',compact('schoolyears'));
    }

    /**
     * Validate and Save data to database
     * @return 
     */
    public function store()
    {
        $validator = Validator::make(Request::all(),[
            'title'     => 'required|min:6',
            'content'   => 'required|min:20',
            'short_des' => 'required',
            'schoolyear'=> 'required'    
        ],[
            'title.required'    => 'Chưa nhập tiêu đề bài viết',
            'title.min'         => 'Tiêu đề quá ngắn',
            'content.required'  => 'Chưa nhập nội dung cho bài viết',
            'content.min'       => 'Nội dung quá ngắn',
            'short_des.required'=> 'Chưa nhập mô tả bài viết',
        ]);

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        News::create([
            'title'         => Request::get('title'),
            'content'       => Request::get('content'),
            'short_des'     => Request::get('short_des'),
            'slug'          => \Illuminate\Support\Str::slug(Request::get('title')), 
            'schoolyear_id' => Request::get('schoolyear')
        ]);
        Alert::success('Tạo bài viết thành công')->persistent('Đóng');

        return redirect()->route('admin.news.index');
    }

    /**
     * Delete a article
     * @param   $id 
     * @return 
     */
    public function delete($id)
    {
        if(Request::ajax())
        {
            $new_id = Request::get('new_id');
            $new =  News::find($new_id);
            $new->delete();
            return response()->json($new_id);
        }
    }

    /**
     * Edit article
     * @param  $id: identify article
     * @return 
     */
    public function edit($id)
    {   $new = News::find($id);
        $schoolyears = Schoolyear::all();
        return view('templates.admins.news.edit',compact('new','schoolyears'));
    }

    /**
     * Validate and save data just edited to database
     * @param  [type] $id : identify article
     * @return
     */
    public function update($id)
    {
        $validator = Validator::make(Request::all(),[
            'title'     => 'required|min:6',
            'content'   => 'required|min:20',
            'short_des' => 'required',
            'schoolyear'=> 'required'    
        ],[
            'title.required'    => 'Chưa nhập tiêu đề bài viết',
            'title.min'         => 'Tiêu đề quá ngắn',
            'content.required'  => 'Chưa nhập nội dung cho bài viết',
            'content.min'       => 'Nội dung quá ngắn',
            'short_des.required'=> 'Chưa nhập mô tả bài viết',
            'schoolyear.required'=> 'Chưa chọn khóa học đăng tin'
        ]);

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $new  = News::findOrFail($id);
        $new->update([
            'title'         => Request::get('title'),
            'content'       => Request::get('content'),
            'short_des'     => Request::get('short_des'),
            'slug'          => \Illuminate\Support\Str::slug(Request::get('title')), 
            'schoolyear_id' => Request::get('schoolyear')
        ]);
        Alert::success('Sửa bài viết thành công')->persistent('Đóng');

        return redirect()->route('admin.news.index');
    }

}