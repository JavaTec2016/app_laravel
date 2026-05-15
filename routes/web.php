<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\Auth\login as AuthLogin;
use App\Http\Controllers\Auth\logout as AuthLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', AuthLogout::class)
    ->middleware('auth')
    ->name('logout');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('login', AuthLogin::class)
    ->middleware('guest');

Route::resource('alumnos', AlumnoController::class)
    ->middleware('auth');
