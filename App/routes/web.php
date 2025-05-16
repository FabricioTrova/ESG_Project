<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;

//Rotas de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas para funcoes de banco

// Página principal onde será exibido o modal e os registros
Route::get('/fontes', [RegistroController::class, 'index'])->name('fontes.index');

// Rota para salvar novo registro (modal de cadastro)
Route::post('/fontes', [RegistroController::class, 'store'])->name('fontes.store');

// Rota para atualizar um registro existente (modal de edição)
Route::put('/fontes/{id}', [RegistroController::class, 'update'])->name('fontes.update');

// Rota para deletar um registro (modal de confirmação de exclusão)
Route::delete('/fontes/{id}', [RegistroController::class, 'destroy'])->name('fontes.destroy');



//Rotas de registro
Route::get('/register', [RegistroController::class, 'showUserForm']);
Route::post('/register', [RegistroController::class, 'registrarUsuario']);

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