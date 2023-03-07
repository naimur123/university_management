<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistrationTime;
use App\Models\User;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    //GetModel
    // private function getModel(){
    //     return new User();
    // }
    public function index(Request $request){
        
        $params = [
            "registrationTime" => StudentRegistrationTime::first(),
            "id"               => $this->extractId($request->user()->user_id)
        ];
        return view('user.courseregistration.start',$params);

    }
}
