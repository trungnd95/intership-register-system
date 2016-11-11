<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Company;
use Auth;
use Request;
use App\Status;
use Alert;
use App\NotificationAdmin;
use App\Events\NotifyAdmin;
use App\AdminConfiguration;
use DB;

class RegisController extends Controller
{
	/**
	 * constructor
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Function to list all company 
     * @param $id-idenfify  student in session
     * @return 
     */
    public function index($id)
    {
        $max_register =  AdminConfiguration::select('max_register')->first();
        $companies = Company::with(['statuses'=>function($result){
            $result -> where('user_id','=',Auth::user()->id);
        }])->get();

        // $companies_available = array();
        // foreach($companies1 as $company)
        // {
        //     if(count($company->statuses) == 0)
        //     {
        //         $companies_available[] = $company->id;
        //     }
        // }
        // $companies =  Company::with('statuses')->whereIn('id',$companies_available)->paginate(10);

        return view('templates.students.registers.index',compact('companies','max_register'));
    }

    /**
     * Function to store data to statuses table 
     * @param $id : identify student in session
     */
    public function store($id)
    {
        $status = Status::where('user_id','=',$id)->delete();
    	$registered_arr = Request::get('items');
        // return $registered_arr;
        foreach($registered_arr as $item)
        {   
            $status = new Status;
            $status->user_id = Auth::user()->id;
            $status->company_id = $item;
            $status->acceptance = "pending";
            $status->save();
            // $company =  Company::find($status->company_id);
            // $notifycationAdmin = new NotificationAdmin;
            // $notifycationAdmin->user_id = $status->user_id;
            // $notifycationAdmin->company_id = $status->company_id;
            // $notifycationAdmin->message   = Auth::user()->user_name.' vừa đăng kí thực tập tại công ty '.$company->name;
            // $notifycationAdmin->seen      = 0;
            // $notifycationAdmin->save();
            // event(new NotifyAdmin($notifycationAdmin));
            
        }
        
        Alert::success('Vui lòng chờ thông báo từ nhà tuyển dụng','Đăng kí thành công')->persistent('Đóng');
        $status = Status::with('company')->where('user_id','=',$id)->get();
        return redirect()->route('student.status.indentify',[$id]);
    }

    /**
     * Function to search company . Handle it by ajax
     * @param $id: identify student
     * @return
     */
    public function search_ajax()
    {
        if(Request::ajax())
        {
            $key_search = Request::get('key_search');
            $companies1 = Company::with(['statuses'=>function($result){
            $result -> where('user_id','=',Auth::user()->id);
            }])->get();
            $companies_available = array();
            foreach($companies1 as $company)
            {
                if(count($company->statuses) == 0)
                {
                    $companies_available[] = $company->id;
                }
            }
            $companies =  Company::with('statuses')->whereIn('id',$companies_available);
            $results = $companies->where('name','LIKE','%'.$key_search.'%')->get();
            $call_view = view('templates.students.registers.search_result',['results'=>$results])->render();
            return response()->json($call_view);
        }
    }

    public function companyDetail($user_id,$company_id)
    {   
        $company = Company::with(['statuses'])->where('id','=',$company_id)->first();
        
        // $company = Company::findOrFail($company_id);
        return view('templates.students.registers.companyDetail',compact('company'));
    }

}
