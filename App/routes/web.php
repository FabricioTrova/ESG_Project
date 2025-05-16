<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return redirect()->route('login');
});

//Rotas de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de registro
Route::get('/register', [RegistroController::class, 'showUserForm']);
Route::post('/register', [RegistroController::class, 'registrarUsuario']);

//Registro fontes de Consumo
Route::get('/fontes', [RegistroController::class, 'index'])->name('fontes.index');
Route::post('/fontes', [RegistroController::class, 'store'])->name('fontes.store');
Route::put('/fontes/{id}', [RegistroController::class, 'update'])->name('fontes.update');
Route::delete('/fontes/{id}', [RegistroController::class, 'destroy'])->name('fontes.destroy');

// Protegidas futuramente com middleware('auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/historico', function () {
    return view('historico');
});

Route::get('/fonteDeConsumo', function () {
    return view('fonteDeConsumo');
});

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/forgot', function () {
    return view('auth.forgot-password');
});