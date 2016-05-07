<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Status;
use Request;
use App\Company;
use App\User;
use App\Events\NotifyStudent;
use Auth;
use App\StudentNotification;

class StatusController extends Controller
{	
	/**
	 * Function get status of all student
	 * @return [type] [description]
	 */
    public function index()
    {
        $students = User::with(['statuses','teacher','statuses.company'])->get();
        return view('templates.admins.status.index',compact('students'));
    }

    /**
     * Update status in admin panel by ajax
     */
    public function update($id)
    {   
        if(Request::ajax())
        {
            $status_id = Request::get('status_id');
             $old_status =  Status::findOrFail($status_id);
            if(Request::get('value') != '')
            {
                $status =  Request::get('value');    
                $old_status->acceptance = $status;
                $old_status->save();
                $company = Company::findOrFail($old_status->company_id);
                
                $notifyStudent = new StudentNotification;
                $notifyStudent->user_id = $old_status->user_id;
                if($old_status->acceptance == 'success')
                {
                    $notifyStudent->message = 'Công ty '.$company->name.' đã chấp nhận bạn vào thực tập tại công ty';
                }else {
                    $notifyStudent->message = 'Công ty '.$company->name.' không chấp nhận bạn vào thực tập tại công ty';
                }
                $notifyStudent->seen = 0;
                $notifyStudent->save();
                event(new NotifyStudent($notifyStudent));
                return response()->json([$status_id,$status]);
            }
            if(Request::get('contact') != '')
            {
                $contact = Request::get('contact');    
                $old_status->contacted = $contact; 
                $old_status->save();
            // $call_view = view('templates.admins.status.status_change',['item'=>$old_status])->render();
                 return response()->json([$status_id,$contact]);  
            }
 
            
        }

    }
    /**
     * Function get status of specific student. In student view
     */
    public function status_identify($id)
    {
        // $status =  Status::where('user_id','=',$id)->get();
        $status = Status::with('company')->where('user_id','=',$id)->paginate(10);
        return view('templates.students.status.index',compact('status'));
    }

    /**
     * Confirm choosen
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm_choosen_company($id)
    {
        $statuses = Status::where('user_id','=',$id)->get();
        foreach($statuses as $item)
        {
            $item->choosen = 0;
            $item->save();
        }

        $company_id = Request::get('company_confirm');
        $status = Status::where('user_id','=',$id)->where('company_id','=',$company_id)->first();
        $status->choosen = 1;
        $status->save();
        $company =  Company::find($company_id);
        return view('templates.students.status.verify',compact('company'));
    }

}

