<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\StudentRegistrationTime;
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
            $this->username()   => 'required|string',
            'password'          => 'required|string|min:3',
        ]);
    }

    public function dashboard(Request $request)
    {
        $now = Carbon::now()->toDateString();
        // $date = StudentRegistrationTime::where('start_date',$now)->get();
        // return StudentRegistrationTime::where();
        $params = [
            "registrationTime" => StudentRegistrationTime::where('start_date',$now)->value('start_date'),
            // "id"               => $this->extractId($request->user()->user_id)
        ];
    
        return view('user.dashboard.home',$params);
    }

    public function logout(){
        
        // return redirect($this->logout) ?: redirect()->back();
        
        return Auth::guard('user')->logout() ?: redirect()->back();
       
        // return redirect($this->logout);
        
    }
}
