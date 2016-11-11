<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use DB;
use Validator;
use Request;
use Alert;
use Auth; 
class CompanyController extends Controller
{
    // public function __construct()
    // {
    // 	$this->middleware('admins');
    // }

    /**
     * List all company 
     * 
     * @return 
     */
    public function index()
    {
    	$companies =  Company::with(['statuses'=>function($query){
    		$query->where('acceptance','=','success')->where('choosen','=',1)->get();
    	}])->get();
    	return view('templates.admins.companies.list',compact('companies'));
    }

    /**
     * Function to show form add new company
     */
    public function add()
    {
    	return view('templates.admins.companies.add');
    }

    /**
     * Validate and Save data to database
     * @return 
     */
    public function store()
    {
    	$validator = Validator::make(Request::all(),[
    		'name'			=> 'required',
    		'address'		=> 'required',
    		'contact'		=> 'required',
    		'short_description'	=> 'required',
    		'services'		=> 'required',
    		'recruitment_amount'=> 'required'
    	],[
    		'name.required'	=> 'Đây là trường bắt buộc',
    		'address.required'	=> 'Đây là trường bắt buộc',
    		'contact.required'	=> 'Đây là trường bắt buộc',
    		'short_description.required'	=> 'Đây là trường bắt buộc',
    		'services.required'	=> 'Đây là trường bắt buộc',
    		'recruitment_amount.required'	=> 'Đây là trường bắt buộc',

    	]);

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	Company::create([
    		'name'			=> Request::get('name'),
    		'address'		=> Request::get('address'),
    		'contact'		=> Request::get('contact'),
    		'description'	=> Request::get('short_description'),
    		'services'		=> Request::get('services'),
    		'recruitment_amount'=> Request::get('recruitment_amount'),
    	]);
    	Alert::success('Đã thêm')->persistent('Đóng');
    	return redirect()->route('admin.companies.index');
    }

    /**
     * Delete company by ajax
     * @param  $id:
     * @return 
     */
    public function delete($id)
    {
    	if(Request::ajax())
    	{
    		$company_id = Request::get('company_id');
    		$company = Company::findOrFail($company_id);
    		$company->delete();
    		return response()->json($company_id);
    	}
    }

    /**
     * show view to edit company
     * @param  $id-identify company
     */
    public function edit($id)
    {
    	$company =  Company::findOrFail($id);
    	return view('templates.admins.companies.edit',compact('company'));
    }

    /**
     * Save data to database
     */
    public function update($id)
    {
    	$validator = Validator::make(Request::all(),[
    		'name'			=> 'required',
    		'address'		=> 'required',
    		'contact'		=> 'required',
    		'short_description'	=> 'required',
    		'services'		=> 'required',
    		'recruitment_amount'=> 'required'
    	],[
    		'name.required'	=> 'Đây là trường bắt buộc',
    		'address.required'	=> 'Đây là trường bắt buộc',
    		'contact.required'	=> 'Đây là trường bắt buộc',
    		'short_description.required'	=> 'Đây là trường bắt buộc',
    		'services.required'	=> 'Đây là trường bắt buộc',
    		'recruitment_amount.required'	=> 'Đây là trường bắt buộc',

    	]);

    	if($validator->fails())
    	{
    		return back()->withInput()->withErrors($validator);
    	}

    	$company  = Company::findOrFail($id);
    	$company->update([
    		'name'			=> Request::get('name'),
    		'address'		=> Request::get('address'),
    		'contact'		=> Request::get('contact'),
    		'description'	=> Request::get('short_description'),
    		'services'		=> Request::get('services'),
    		'recruitment_amount'=> Request::get('recruitment_amount'),
    	]);
    	Alert::success('Đã chỉnh sửa')->persistent('Đóng');
    	return redirect()->route('admin.companies.index');	
    }

    /**
     * [listAll description]
     * @return [type] [description]
     */
    public function listAll()
    {
        $companies = Company::paginate(10);
        if(Auth::guard('teachers')->getUser() == null)
        {
            return view('templates.students.news.list',compact('companies'));    
        }
        else {
            return view('templates.teachers.news.list',compact('companies'));    
        }
        
    }    

    public function detail($company_id)
    {   
        $company = Company::with(['statuses'])->where('id','=',$company_id)->first();
        return view('templates.students.registers.companyDetail',compact('company'));        
    }
}
