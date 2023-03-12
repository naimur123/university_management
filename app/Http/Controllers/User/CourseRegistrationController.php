<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\StudentRegistrationTime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    //GetModel
    // private function getModel(){
    //     return new User();
    // }
    public function index(Request $request){
        $now = Carbon::now()->toDateString();
        

        $id = $this->stringId($request->user()->user_id);
        $params = [
            "registrationTime" =>StudentRegistrationTime::where('from',$id)->orWhere('to',$id)->get(),
            "id"               => $this->extractId($request->user()->user_id),
            "courses"          => Course::with('courseTimeSchedule')->where('department_id', $request->user()->department_id)->get()
        ];

        // dd($params);
        return view('user.courseregistration.start',$params);

    }
}
