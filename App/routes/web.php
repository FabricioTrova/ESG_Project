<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/history',function(){
    return View('history');
});
Route::get('/charts', function(){
    return view('charts');
});