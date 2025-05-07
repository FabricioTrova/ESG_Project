<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;

//Rotas de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de registro
Route::get('/register', [RegistroController::class, 'showForm']);
Route::post('/register', [RegistroController::class, 'registrar']);

// Protegidas futuramente com middleware('auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/history', function () {
    return view('history');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/forgot', function () {
    return view('auth.forgot-password');
});