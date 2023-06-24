<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\StudentTakenCourse;
use Illuminate\Http\Request;

class ClassViewController extends Controller
{
    //class view
    public function classView(Request $request){
        $data = StudentTakenCourse::where('course_time_schedule_id', $request->schedule_id)->where('is_confirmed', 1)->where('is_completed', 0)->get();
        dd($data);
    }
}
