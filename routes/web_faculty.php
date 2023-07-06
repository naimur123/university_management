<?php

use App\Http\Controllers\Faculty\Auth\FacultyLoginController;
use App\Http\Controllers\Faculty\ClassViewController;
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

// Route::get('/faculty', function () {
//     return view('welcome');
// });

Route::get('/faculty/login',[FacultyLoginController::class,'showloginForm']);
Route::post('/faculty/login',[FacultyLoginController::class,'login'])->name('faculty.login');
Route::middleware('auth:faculty')->group(function(){

    Route::prefix('faculty')->name('faculty.')->group(function(){
        Route::get('/home',[FacultyLoginController::class, 'dashboard'])->name('home');
        Route::get('/logout',[FacultyLoginController::class,'logout'])->name('logout');

        //class view
        Route::get('/class/view/{schedule_id}',[ClassViewController::class,'classView'])->name('class.view');

        //upload notes
        Route::post('/upload/notes/{schedule_id}',[ClassViewController::class,'uploadNotes'])->name('upload_notes');
        
        //upload notice
        Route::post('/upload/notices/{schedule_id}',[ClassViewController::class,'uploadNotices'])->name('upload_notices');
        
       
    });

});

require('web_administrator.php');


