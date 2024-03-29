<?php

use App\Http\Controllers\Administrator\Auth\LoginController;
use App\Http\Controllers\Administrator\CourseController;
use App\Http\Controllers\Administrator\CourseTimeScheduleController;
use App\Http\Controllers\Administrator\FacultyController;
use App\Http\Controllers\Administrator\StudentController;
use App\Http\Controllers\Administrator\StudentRegistrationTimeController;
use App\Http\Controllers\Administrator\VerificationController;
use Database\Factories\FacultyFactory;
use Illuminate\Support\Facades\Route;



Route::get('/validate', [VerificationController::class,'verify']);

Route::get('/admin/login',[LoginController::class, 'showloginform']);
Route::post('/admin/login',[LoginController::class, 'login'])->name('admin.login');



Route::middleware('auth:admin')->group(function(){

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/home',[LoginController::class, 'dashboard'])->name('home');
        Route::get('/logout',[LoginController::class,'logout'])->name('logout');


        // faculty
        Route::get('/faculty-list',[FacultyController::class,'index'])->name('faculty.list');
        Route::get('/assign_faculty',[FacultyController::class,'create'])->name('assign_faculty');
        Route::get('/faculty/edit/{id}',[FacultyController::class,'edit'])->name('faculty.edit');
        Route::post('/assign_faculty',[FacultyController::class,'store'])->name('faculty.store');
        Route::get('/faculty/passcheck/{id}',[FacultyController::class,'passcheck'])->name('faculty.passcheck');

        // course list
        Route::get('/course-list/{name}',[CourseController::class,'index'])->name('course.list');

        //student
        Route::get('/sudent-list/{name}',[StudentController::class,'index'])->name('student.list');
        Route::get('/assign_student/{name}',[StudentController::class,'create'])->name('assign_student');
        Route::get('/student/edit/{name}/{id}',[StudentController::class,'edit'])->name('student.edit');
        Route::post('/assign_studnet',[StudentController::class,'store'])->name('student.store');
        // Route::get('/assign_studnet/{id}',[FacultyController::class,'edit'])->name('assign_faculty.edit');
        Route::get('/student-list/report/{name}',[StudentController::class,'report'])->name('student.report');

        //Course Time schedule
        Route::get('/course-schedule/{name}',[CourseTimeScheduleController::class,'create'])->name('course_schedule');
        Route::post('/course-schedule',[CourseTimeScheduleController::class,'store'])->name('course_schedule.store');
        Route::get('/reg-course-schedule/{name}',[CourseTimeScheduleController::class,'getFacultySection'])->name('reg.course');

        //Student Registration Time
        Route::get('/student-registration-time',[StudentRegistrationTimeController::class,'create'])->name('student.reg.time');
        Route::post('/student-registration-time',[StudentRegistrationTimeController::class,'store'])->name('student.reg.time.store');

    });

});

// require('web.php');