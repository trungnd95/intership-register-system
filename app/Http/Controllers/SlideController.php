<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slide;
use Validator;
use Request;
use Alert;
use File;

class SlideController extends Controller
{
	/**
	 * Constructor
	 */
    public function __construct()
    {
    	$this->middleware('admins');
    }

    /**
     * List all slide
     * @return 
     */
    public function index()
    {
    	$slides = Slide::select('id','image')->orderBy('id','DESC')->get();
    	return view('templates.admins.slides.list',compact('slides'));
    }

    /**
     * Form add slide
     */
    public function add()
    {
    	return view('templates.admins.slides.add');
    }

    /**
     * Store data just added to database
     * @return 
     */
    public function store()
    {
    	$validator = Validator::make(Request::all(),[
    			'description'	=> 'required',
    			'slide'			=> 'required'
    		],[
    			'description.required'	=> 'Nhập link cho slide',
    			'slide.required'		=> 'Chưa chọn slide',
    			// 'slide.image'			=> 	'Slide chỉ chứa định dạng ảnh'
    		]);

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	// if(Request::file('slide'))
    	// {
    	// 	$slide_name = Request::file('slide')->getClientOriginalName();
    	// 	$des = base_path().'/public/upload/images/slides/';
    	// 	Request::file('slide')->move($des,$slide_name);

		Slide::create([
			'image'	=> Request::get('slide'),
			'description' => Request::get('description')
		]);

		return redirect()->route('admin.slides.index');
    	// }
    }

    /**
     * Delete slide using ajax
     * @param  [type] $id - identify slide
     * @return view index
     */
    public function delete($id)
    {
    	if(Request::ajax())
    	{
    		$slide_id = Request::get('slide_id');
    		$slide =  Slide::findOrFail($slide_id);
    		//delete image in folder
    		File::delete(base_path().'/public/upload/images/slides/'.$slide->image);
    		$slide->delete();
    		return response()->json($slide_id);
    	}
    }

    /**
     * Function to get view edit slide
     * @param  [type] $id -specify slide
     * @return view edit
     */
    public function edit($id)
    {
    	$slide = Slide::findOrFail($id);
    	return view('templates.admins.slides.edit',compact('slide'));
    }
    
    /**
     * Function to validate and store data just edited to database
     * @param  [type] $id -specify slide
     * @return view index
     */
    public function update($id)
    {
    	$validator = Validator::make(Request::all(),[
    			'description'	=> 'required',
    			'slide'			=> 'required'
    		],[
    			'description.required'	=> 'Nhập link cho slide',
    			'slide.required'		=> 'Chưa chọn slide',
    			// 'slide.image'			=> 	'Slide chỉ chứa định dạng ảnh'
    		]);

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	// $slide = Slide::findOrFail($id);
    	// $image = $slide->image;
    	// if(Request::file('slide'))
    	// {
    	// 	//Delete old image
    	// 	$old_image = base_path().'/public/upload/images/slides/'.$slide->image;
    	// 	File::delete($old_image);

    	// 	//Upload new image
    	// 	$image = Request::file('slide')->getClientOriginalName();
    	// 	$des = base_path().'/public/upload/images/slides/';
    	// 	Request::file('slide')->move($des,$image);
    	// }

    	$slide->update([
    		'description'	=> Request::get('description'),
    		'image'			=> Request::get('slide')
    	]);
    	Alert::success('Đã sửa','','success');
    	return redirect()->route('admin.slides.index');
    }
}
