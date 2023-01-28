<?php

use App\Http\Controllers\Administrator\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login',[LoginController::class, 'showloginform']);
Route::post('/admin/login',[LoginController::class, 'login'])->name('admin.login');
Route::get('/admin/home',[LoginController::class, 'dashboard'])->name('admin.home');