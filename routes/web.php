<?php

use App\Http\Controllers\User\Auth\StudentLoginController;
use App\Http\Controllers\User\ClassDetailsController;
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

        //Registered course list
        Route::get('registered/course',[CourseRegistrationController::class,'courseRegisteredList'])->name('course.registered.list');
        // Drop registered course
        Route::get('registered/coursedrop',[CourseRegistrationController::class,'dropRegCourse'])->name('course.registered.drop');

        //mark read notification
        Route::get('/notification/mark-as-read',[StudentLoginController::class,'markRead'])->name('noti.markRead');

        //get notes
        Route::get('/class/{schedule_id}/{name}',[ClassDetailsController::class,'classTab'])->name('class.tab');
        // Route::get('/class/{schedule_id}/noticeTab',[ClassDetailsController::class,'classTab'])->name('class.noticeTab');

        //download file
        Route::get('/document/download/{path}',[ClassDetailsController::class,'fileDownload'])->name('document.download');

    });

});


require('web_administrator.php');

// require('web_faculty.php');
