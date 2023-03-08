<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $params = [
            "registrationTime" => StudentRegistrationTime::where('start_date',$now)->get(),
            "id"               => $this->extractId($request->user()->user_id)
        ];
        return view('user.courseregistration.start',$params);

    }
}
