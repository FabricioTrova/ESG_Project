<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AdicionarEmpresaController;
use App\Http\Controllers\FonteConsumoController;
use App\Http\Controllers\ConsumoController;

//Redireciona a raiz para a rota de login
Route::get('/', function () {
    return redirect()->route('login');
});

//Rotas de login usuario
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de registro usuario 
Route::middleware(['auth', 'tipo_usuario:admin'])->group(function () {
    Route::get('/register', [RegistroController::class, 'showUserForm']);
    Route::post('/register', [RegistroController::class, 'registrarUsuario']);;
});

Route::get('/fonteDeConsumo', function () {
    return view('fonteDeConsumo');
});
//Registro fontes de Consumo
Route::middleware(['auth', 'tipo_usuario:admin,gestor'])->group(function () {
    Route::get('/fontes', [FonteConsumoController::class, 'index'])->name('fontes.index');
    Route::post('/fontes', [FonteConsumoController::class, 'store'])->name('fontes.store');
    Route::put('/fontes/{id}', [FonteConsumoController::class, 'update'])->name('fontes.update');
    Route::delete('/fontes/{id}', [FonteConsumoController::class, 'destroy'])->name('fontes.destroy');
});

Route::get('/historico', [ConsumoController::class, 'index'])->name('consumos.historico');
//Registro de Consumos
Route::middleware(['auth', 'tipo_usuario:admin,gestor,colaborador'])->group(function () {
    Route::get('/consumos', [ConsumoController::class, 'index'])->name('consumos.index');
    Route::post('/consumos', [ConsumoController::class, 'store'])->name('consumos.store');
    Route::put('/consumos/{id}', [ConsumoController::class, 'update'])->name('consumos.update');
    Route::delete('/consumos/{id}', [ConsumoController::class, 'destroy'])->name('consumos.destroy');
});

// Protegidas futuramente com middleware('auth')
Route::middleware(['auth', 'tipo_usuario:admin,gestor,colaborador'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/charts', function () {
        return view('charts');
    });
});

// Rotas para adicionar empresa
Route::middleware(['auth', 'tipo_usuario:admin'])->group(function () {
    Route::get('/empresas', [AdicionarEmpresaController::class, 'index'])->name('empresas.index');
    Route::post('/empresas', [AdicionarEmpresaController::class, 'store'])->name('empresas.store');
    Route::delete('/empresas/{id}', [AdicionarEmpresaController::class, 'destroy'])->name('empresas.destroy');
});

//Ainda não implementada
Route::get('/forgot', function () {
    return view('auth.forgot-password');
});
