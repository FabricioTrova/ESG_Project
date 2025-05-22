<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AdicionarEmpresaController;
use App\Http\Controllers\FonteConsumoController;
use App\Http\Controllers\ConsumoController;

Route::get('/', function () {
    return redirect()->route('login');
});

//Rotas de login usuario
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de registro usuario 
Route::get('/register', [RegistroController::class, 'showUserForm']);
Route::post('/register', [RegistroController::class, 'registrarUsuario']);

Route::get('/fonteDeConsumo', function () {
    return view('fonteDeConsumo');
});
//Registro fontes de Consumo
Route::get('/fontes', [FonteConsumoController::class, 'index'])->name('fontes.index');
Route::post('/fontes', [FonteConsumoController::class, 'store'])->name('fontes.store');
Route::put('/fontes/{id}', [FonteConsumoController::class, 'update'])->name('fontes.update');
Route::delete('/fontes/{id}', [FonteConsumoController::class, 'destroy'])->name('fontes.destroy');

Route::get('/historico', function () {
    return view('consumo');
});
//Registro de Consumos
Route::get('/consumos', [ConsumoController::class, 'index'])->name('consumos.index');
Route::post('/consumos', [ConsumoController::class, 'store'])->name('consumos.store');
Route::put('/consumos/{id}', [ConsumoController::class, 'update'])->name('consumos.update');
Route::delete('/consumos/{id}', [ConsumoController::class, 'destroy'])->name('consumos.destroy');

// Protegidas futuramente com middleware('auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/forgot', function () {
    return view('auth.forgot-password');
});

// Rotas para adicionar empresa
Route::get('/empresas', [AdicionarEmpresaController::class, 'index'])->name('empresas.index');
Route::post('/empresas', [AdicionarEmpresaController::class, 'store'])->name('empresas.store');