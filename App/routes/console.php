<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Rotas de Console
|--------------------------------------------------------------------------
|
| Este arquivo é onde você pode definir todos os comandos de console baseados
| em Closures. Cada Closure está vinculada a uma instância de comando, permitindo
| uma abordagem simples para interagir com os métodos de IO de cada comando.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
