<?php

use App\Http\Controllers\User\Auth\StudentLoginController;
use App\Http\Controllers\User\CourseRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/student/login',[StudentLoginController::class,'showloginForm']);
Route::post('/student/login',[StudentLoginController::class,'login'])->name('student.login');
Route::middleware('auth:user')->group(function(){

    Route::prefix('student')->name('student.')->group(function(){
        Route::get('/home',[StudentLoginController::class, 'dashboard'])->name('home');
        Route::get('/logout',[StudentLoginController::class,'logout'])->name('logout');

        //Course registration
        Route::get('course/registration',[CourseRegistrationController::class,'index'])->name('course.registration');
        Route::post('course/registration',[CourseRegistrationController::class,'store'])->name('course.registration.store');

    });

});


require('web_administrator.php');

