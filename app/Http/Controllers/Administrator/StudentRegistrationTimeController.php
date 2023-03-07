<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistrationTime;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentRegistrationTimeController extends Controller
{
     //GetModel
     private function getModel(){
        return new StudentRegistrationTime();
    }

    // add student reg time
   public function create(Request $request){
    $params = [
        "title"       =>   "Student Registration Time Set",
        "form_url"    => route('admin.student.reg.time.store'),
    ];

    return view('administrator.studentregtime.create',$params);
   }

   //store student reg time
   public function store(Request $request){
    try{
        DB::beginTransaction();
        if( $request->id == 0 ){
            $data = $this->getModel();
            $data->id =  Str::uuid();
        }
        else{
            $data = $this->getModel()->find($request->id);
            
        }

        $data->from       = $request->from;
        $data->to         = $request->to;
        $data->start_date = $request->start_date;
        $data->start_time = $request->start_time;
        $data->end_date   = $this->getEndDate($request);
        $data->end_time   = $this->getEndTime($request);
        $data->save();
        
        DB::commit();
        try{
            if($request->id == 0){
                event(new Registered($data));
            }
        }catch(Exception $e){
            //
        }
    }catch(Exception $e){
        DB::rollBack();
        return back()->with("error", $this->getError($e))->withInput();
    }

    return back()->with("success", $request->id == 0 ? "Student Registration Time Added SuccessFully" : "Student Registration Time Updated Successfully");
   }

   //Get End date
   public function getEndDate($request){

        $start_date = Carbon::parse($request->start_date);
        $end_day    = $start_date->addDay(1);

        return $end_day;
   }
   //Get End time
   public function getEndTime($request){

        $start_time = Carbon::parse($request->start_time);
        $end_time = $start_time->copy()->addHours(23)->addMinutes(59);
      
        return $end_time;

   }
}
