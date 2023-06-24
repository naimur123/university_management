<?php

namespace App\Http\Controllers\Faculty\Auth;

use App\Http\Controllers\Controller;
use App\Models\CourseTimeSchedule;
use App\Models\Department;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class FacultyLoginController extends Controller
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
        $this->redirectTo = route("faculty.home");
        $this->logout = route("faculty.login");
        
    }

    protected function guard()
    {
        return Auth::guard('faculty');
    }

    public function showloginForm()
    {
       
        if( Auth::guard('faculty')->check() ){
            
            return redirect($this->redirectTo);
        }
        // Toastr::info('Admin Login page','Title', ["positionClass" => "toast-top-right"]);
        return view('faculty.auth.login');
        
        
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
        $params = [
            // "departments" => Department::all()
            // "getCourseList" => CourseTimeSchedule::with('courses')->where('faculty_id',$request->user()->id)->get()
            "getCourseList" => CourseTimeSchedule::with('courses')->where('faculty_id',$request->user()->id)->get()
        ];
        // dd($params);
        return view('faculty.dashboard.home',$params);
    }

    public function logout(){
        
        // return redirect($this->logout) ?: redirect()->back();
        
        return Auth::guard('faculty')->logout() ?: redirect()->back();
       
        // return redirect($this->logout);
        
    }
}
