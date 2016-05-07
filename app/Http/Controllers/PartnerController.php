<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Request;
use App\Partner;
use Validator;

class PartnerController extends Controller
{
	/**
	 * [__construct description]
	 */
    public function __construct()
    {

    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	$logos = Partner::all();
    	return view('templates.admins.partners.list',compact('logos'));
    }

    /**
     * [add description]
     */
    public function add()
    {
    	return view('templates.admins.partners.add');
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store()
    {
    	$validator = Validator::make(Request::all(),[
    		'logo'	=> 'required'
    	],[
    		'logo.required'	=> 'Chưa chọn logo'	
    	]);
    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	Partner::create([
    		'image'	=> Request::get('logo'),
    		'link'	=> Request::get('description')
    	]);
    	return redirect()->route('admin.partner.index');
    }

    public function delete($id)
    {
    	if(Request::ajax())
    	{
    		$logo_id = Request::get('logo_id');
    		$logo =  Partner::findOrFail($logo_id);
    		$logo->delete();
    		return response()->json($logo_id);
    	}
    }
}
