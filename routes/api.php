<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importamos el controlador en donde se encuentra
use App\Http\Controllers\Api\usuarioController;
use App\Http\Controllers\Api\loginController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Ruta API para llamar a todos los usuarios -- comentado por ahora
// Route::get('/usuario', function () {
//     return 'Usuarios del sistema';
// });

// Ruta iniciar sesion y generar el token
Route::post('/login', [loginController::class, 'login']);



// Esta ruta Api contiene un grupo de rutas que van a estar protegidas por autenticacion
Route::middleware('auth:api')->group(
    function () {
        Route::get('/usuario', [usuarioController::class, 'index']);
        Route::post('/logout', [loginController::class, 'logout']);
});


// RUTAS PARA EL REGISTRO E INICIO DE SESION
Route::post('/registrarse', [loginController::class, 'registrarse']);



// RUTAS PARA EL USUARIO
// Ruta API para llamar a todos los usuarios
//Route::get('/usuario', [usuarioController::class, 'index']);


// Ruta API para llamar a un Usuario especifco
Route::get('/usuario/{id_usuario}', [usuarioController::class, 'show']);

// Ruta API para crear un usuario
Route::post('/usuario', [usuarioController::class, 'store']);

// Ruta API para modificar la informacion de un usuario
Route::put('/usuario/{id_usuario}', [usuarioController::class, 'update']);

// Ruta API para eliminiar a un usuario
Route::delete('/usuario/{id_usuario}', [usuarioController::class, 'destroy']);