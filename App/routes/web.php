<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::get('/registro', [RegistroController::class, 'index'])->name('registro.index');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');


/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas web para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora crie algo incrível!
|
*/
Route::get('/', function () {
    return view('dashboard'); // Carrega a View dashboard.blade.php
});

Route::get('/history',function(){// Carrega a View history.blade.php
    return View('history');
});

Route::get('/charts', function(){// Carrega a View charts.blade.php
    return view('charts');
});

Route::get('/login', function(){// Carrega a View login.blade.php
    return view('auth.login');
});

Route::get('/register', function(){// Carrega a View register.blade.php
    return view('auth.register');
});

Route::get('/forgot', function(){// Carrega a View forgot-password.blade.php
    return view('auth.forgot-password');
});

Route::resource('registro', RegistroController::class);

