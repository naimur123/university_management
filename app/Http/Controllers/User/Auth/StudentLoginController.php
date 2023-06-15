<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTimeSchedule;
use App\Models\Department;
use App\Models\StudentRegistrationTime;
use App\Models\StudentTakenCourse;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class StudentLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo;
    protected $logout;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route("student.home");
        $this->logout = route("student.login");
        
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showloginForm()
    {
       
        if( Auth::guard('user')->check() ){
            
            return redirect($this->redirectTo);
        }
        // Toastr::info('Admin Login page','Title', ["positionClass" => "toast-top-right"]);
        return view('user.auth.login');
        
        
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username()   => 'required',
            'password'          => 'required|string|min:3',
        ]);
    }

    public function dashboard(Request $request)
    {    
        // $reg_courses = StudentTakenCourse::where('user_id',$request->user()->id)->pluck('course_time_schedule_id')->toArray();
        // $getCourse = CourseTimeSchedule::with('courses')->whereIn('id',$reg_courses)->get();
        // $getCourse = CourseTimeSchedule::with('courses')
        //                 ->join('student_taken_courses', 'course_time_schedules.id', '=', 'student_taken_courses.course_time_schedule_id')
        //                 ->where('student_taken_courses.user_id', $request->user()->id)
        //                 ->get(['course_time_schedules.*']);
        // dd($getCourse);
        $idF = $this->extractFirstTwo($request->user()->user_id);
        $idL = $this->extractLastOne($request->user()->user_id);
        $params = [
            "today" => Carbon::now()->toDateString(),
            "checkDate" => StudentRegistrationTime::where('from',$idF)->where('to',$idL)->get(),
            "getRegisteredCourses" => CourseTimeSchedule::with('courses')
                                        ->join('student_taken_courses', 'course_time_schedules.id', '=', 'student_taken_courses.course_time_schedule_id')
                                        ->where('student_taken_courses.user_id', $request->user()->id)
                                        ->get(['course_time_schedules.*'])
        ];
        // dd($params);
        return view('user.dashboard.home',$params);
    }

    public function logout(){
        return Auth::guard('user')->logout() ?: redirect()->back();
    }
}
