<?php

namespace App\Http\Controllers\Administrator\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if( Auth::guard('admin')->check() ){
            return redirect($this->redirectTo);
        }
    
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
        Auth::guard('admin')->logout() ?: redirect()->back();
        return redirect($this->logout);
        
    }
}
