<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('canal-publico', function () {
    return true; // Canal abierto para todos
});

// Broadcast::routes(['middleware' => ['auth:api']]);

// Broadcast::channel( 'App.Models.User.{documento}', function ($user, $documento) {
//     Log::info('Mensaje', ['usuarioi' => $user->documento, 'id' => $documento]);
//     return $user->documento === $documento;
// });
