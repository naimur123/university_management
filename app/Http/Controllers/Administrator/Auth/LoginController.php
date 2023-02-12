<?php

namespace App\Http\Controllers\Administrator\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
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
        $this->redirectTo = route("admin.home");
        $this->logout = route("admin.login");
        
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showloginForm()
    {
        // $currentUrl = Url::current();
        // echo $currentUrl;
        if( Auth::guard('admin')->check() ){
            
            return redirect($this->redirectTo);
        }
        // Toastr::info('Admin Login page','Title', ["positionClass" => "toast-top-right"]);
        return view('administrator.auth.login');
        
        
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
        
        return view('administrator.home');
    }

    public function logout(){
        
        // return redirect($this->logout) ?: redirect()->back();
        
        return Auth::guard('admin')->logout() ?: redirect()->back();
       
        // return redirect($this->logout);
        
    }
}
