<?php

use App\Http\Controllers\Administrator\Auth\LoginController;
use App\Http\Controllers\Administrator\FacultyController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login',[LoginController::class, 'showloginform']);
Route::post('/admin/login',[LoginController::class, 'login'])->name('admin.login');



Route::middleware('auth:admin')->group(function(){

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/home',[LoginController::class, 'dashboard'])->name('home');
        Route::get('/logout',[LoginController::class,'logout'])->name('logout');


        // faculty
        Route::get('/faculty-list',[FacultyController::class,'index'])->name('faculty.list');
        Route::get('/assign_faculty',[FacultyController::class,'create'])->name('assign_faculty');
        Route::get('/assign_faculty/{id}',[FacultyController::class,'edit'])->name('assign_faculty.edit');
        Route::post('/assign_faculty',[FacultyController::class,'store'])->name('assign_faculty.store');
    });

});