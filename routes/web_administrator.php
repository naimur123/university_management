<?php

use App\Http\Controllers\Administrator\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login',[LoginController::class, 'showloginform']);
Route::post('/admin/login',[LoginController::class, 'login'])->name('admin.login');



Route::middleware('auth:admin')->group(function(){

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/home',[LoginController::class, 'dashboard'])->name('home');
        Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    });

});