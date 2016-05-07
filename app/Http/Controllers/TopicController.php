<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Topic;
use Request;
use Validator;
use Alert;

class TopicController extends Controller
{
	/**
	 * Constructor
	 */
    // public function __construct()
    // {
    // 	$this->middleware('auth');
    // }

    /**
     * Function to register topic or edit if exist
     * @param  $id - identify student
     * @return 
     */
    public function index($id)
    {   
        $topic = Topic::where('user_id','=',$id)->first();
        return view('templates.students.topic.index',compact('topic'));
    }

    /**
     * Function to get view form regis topic
     * @param  $id - identify student
     * @return 
     */
    public function add($id)
    {
        return view('templates.students.topic.add');
    }

 	/**
     * Function to store data just registered to Topic table
     * @param  $id - identify student
     * @return 
     */
    public function store($id)
    {
        $validator = Validator::make(Request::all(),[
                'title'         => 'required|min:5|unique:topics',
                'short_des'     => 'required'
        ],[
                'title.required'=> 'Tên đề tài không được trống',
                'title.min'     => 'Tên đề tài quá ngắn',
                'title.unique'  => 'Đề tài này đã có người đăng kí rồi',
                'short_des'     => 'Bạn hãy mô tả 1 chút về đề tài của mình'
        ]);

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $topic = Topic::where('user_id','=',$id)->get();
        if(count($topic) > 0)
        {
            Alert::error("Bạn chỉ được đăng kí 1 đề tài")->persistent("Đóng");
            return back()->withInput();
        }

        Topic::create([
            'title'     => Request::get('title'),
            'short_des' => Request::get('short_des'),
            'user_id'   => $id
        ]);
        Alert::success('Đăng kí thành công')->persistent("Đóng");
        return redirect()->route('student.topic.index',[$id]);
    }

    /**
     * Edit topic registered
     * @param   $id -identify student
     * @param 	$topic_id - identify topic want to edit
     * @return 
     */
    public function edit($id,$topic_id)
    {
        $topic =  Topic::find($topic_id);
        return view('templates.students.topic.edit',compact('topic'));
    }

    /**
     * Store data just edited to Topic table
     * @param   $id -identify student
     * @param 	$topic_id - identify topic want to edit
     * @return 
     */
    public function update($id,$topic_id)
    {
        $validator = Validator::make(Request::all(),[
                'title'         => 'required|min:5',
                'short_des'     => 'required'
        ],[
                'title.required'=> 'Tên đề tài không được trống',
                'title.min'     => 'Tên đề tài quá ngắn',
                'short_des'     => 'Bạn hãy mô tả 1 chút về đề tài của mình'
        ]);

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $topic =  Topic::find($topic_id);
        $topic->update([
            'title'     => Request::get('title'),
            'short_des' => Request::get('short_des'),
            'user_id'   => $id
        ]);
        Alert::success('Thay đổi thành công')->persistent("Đóng");
        return redirect()->route('student.topic.index',[$id]);
    }

       
}
