<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\StudentRegistrationTime;
use App\Models\StudentTakenCourse;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseRegistrationController extends Controller
{
    // GetModel
    private function getModel(){
        return new StudentTakenCourse();
    }
    public function index(Request $request){
        // $now = Carbon::now()->toDateString();
        

        $idF = $this->extractFirstTwo($request->user()->user_id);
        $idL = $this->extractLastOne($request->user()->user_id);
        $params = [
            "today" => Carbon::now()->toDateString(),
            "now"   => Carbon::now()->toTimeString(),
            "registrationTime" => StudentRegistrationTime::where('from',$idF)->where('to',$idL)->get(),
            "courses"          => Course::with('courseTimeSchedule')->where('department_id', $request->user()->department_id)->get(),
            "takenCourses"    => StudentTakenCourse::with('course_time')->where('user_id',$request->user()->id)->get(),
            "form_url"        => route('student.course.registration.store')
        ];

        // dd($params);
        return view('user.courseregistration.start',$params);

    }

    public function store(Request $request){
        // dd($request->all());
        try{
            foreach($request->course_schedule_id as $scheduleid){

                $data = $this->getModel();
                $data->id         =  Str::uuid();
                $data->user_id    =  $request->user()->id;
                $data->course_time_schedule_id = $scheduleid;
                $data->save();
                DB::commit();
            }
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        return back()->with("success","Course taken Successfully");
    }
            
       
}
