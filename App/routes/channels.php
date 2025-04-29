<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Canais de Transmissão
|--------------------------------------------------------------------------
|
| Aqui você pode registrar todos os canais de transmissão de eventos que
| sua aplicação suporta. Os callbacks de autorização fornecidos são usados
| para verificar se um usuário autenticado pode ouvir o canal.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
