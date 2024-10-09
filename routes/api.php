<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importamos el controlador en donde se encuentra
use App\Http\Controllers\Api\usuarioController;
use App\Http\Controllers\Api\loginController;
use App\Http\Controllers\Api\codigoController;
use App\Http\Controllers\Api\foroController;
use App\Http\Controllers\Api\padreController;
use App\Http\Controllers\Api\hijoController;
use App\Http\Controllers\Api\preconsultaController;
use App\Http\Controllers\Api\historiaclinicaController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Ruta API para llamar a todos los usuarios -- comentado por ahora
// Route::get('/usuario', function () {
//     return 'Usuarios del sistema';
// });

// RUTAS PARA EL REGISTRO E INICIO DE SESION
Route::post('/registrarse', [loginController::class, 'registrarse']);

// Ruta iniciar sesion y generar el token
Route::post('/login', [loginController::class, 'login']);


// Esta ruta Api contiene un grupo de rutas que van a estar protegidas por autenticacion
Route::middleware('auth:api')->group(function () {
    // Ruta para cerrar la sesión
    Route::post('/logout', [loginController::class, 'logout']);
});

// ROL 1 ADMIN Y ROL 2 USUARIO NORMAL

Route::middleware(['auth:api', 'rol:1,2'])->group(function () {
    // RUTAS PARA EL FORO
    // Ruta API para llamar a todos los foros
    Route::get('/foro', [foroController::class, 'index']);


    // RUTAS PARA EL PADRE
    // Ruta API para llamar a un padre especifco
    Route::get('/padre/{id_padre}', [padreController::class, 'show']);

    // Ruta API para modificar la informacion de un padre
    Route::put('/padre/{id_padre}', [padreController::class, 'update']);

    // Ruta API para llamar solamente a los hijos de un padre
    Route::get('/hijosdepadre/{id_padre}', [padreController::class, 'hijosdepadre']);
    //Route::post('hijosdepadre', [padreController::class, 'hijosdepadre']); ESTE ES IGUAL AL DE ARRIBA, PERO CON POST


    // RUTAS PARA EL HIJO
    // Ruta API para crear un hijo
    Route::post('/hijo', [hijoController::class, 'store']);

    // Ruta API para llamar a un hijo especifco
    Route::get('/hijo/{id_hijo}', [hijoController::class, 'show']);

    // Ruta API para modificar la informacion de un hijo
    Route::put('/hijo/{id_hijo}', [hijoController::class, 'update']);

    // Ruta API para eliminiar a un hijo
    Route::delete('/hijo/{id_hijo}', [hijoController::class, 'destroy']);


    // RUTAS PARA EL PRECONSULTA
    // Ruta API para crear una preconsulta
    Route::post('/preconsulta', [preconsultaController::class, 'store']);

    // Ruta API para llamar a una preconsulta especifca
    Route::get('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'show']);

    // Ruta API para modificar la informacion de una preconsulta
    Route::put('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'update']);

    // Ruta API para llamar solamente a las preconsultas de un hijo
    Route::get('/preconsdelhijo/{id_hijo}', [preconsultaController::class, 'preconsdelhijo']);


    // RUTAS A HISTORIA CLINICA
    // Ruta API para llamar a una Historia Clinica especifca
    Route::get('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'show']);

    //Ruta API para llamar solamente a las historias clinicas del hijo
    Route::get('/historiasdelhijo/{id_hijo}', [historiaclinicaController::class, 'historiasdelhijo']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A USUARIO
    // Ruta API para crear un usuario
    Route::post('/usuario', [usuarioController::class, 'store']);

    // Ruta API para llamar a todos los usuarios
    Route::get('/usuario', [usuarioController::class, 'index']);

    // Ruta API para llamar a un Usuario especifco
    Route::get('/usuario/{id_usuario}', [usuarioController::class, 'show']);

    // Ruta API para modificar la informacion de un usuario
    Route::put('/usuario/{id_usuario}', [usuarioController::class, 'update']);

    // Ruta API para eliminiar a un usuario
    Route::delete('/usuario/{id_usuario}', [usuarioController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA LOS CODIGOS
    // Ruta API para crear un codigos
    Route::post('/codigo', [codigoController::class, 'store']);

    // Ruta API para llamar a todos los codigos
    ///Route::get('/codigo', [codigoController::class, 'index']);

    // Ruta API para llamar a un codigos especifco
    Route::get('/codigo/{cod_codigo}', [codigoController::class, 'show']);

    // Ruta API para modificar la informacion de un codigos
    Route::put('/codigo/{cod_codigo}', [codigoController::class, 'update']);

    // Ruta API para eliminiar un codigos
    Route::delete('/codigo/{cod_codigo}', [codigoController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL FORO
    // Ruta API para crear un foro
    Route::post('/foro', [foroController::class, 'store']);

    // Ruta API para llamar a todos los foros
    //Route::get('/foro', [foroController::class, 'index']); PARA AMBBOS ROLES

    // Ruta API para llamar a un foro especifco
    Route::get('/foro/{cod_foro}', [foroController::class, 'show']);

    // Ruta API para modificar la informacion de un foro
    Route::put('/foro/{cod_foro}', [foroController::class, 'update']);

    // Ruta API para eliminiar a un foro
    Route::delete('/foro/{cod_foro}', [foroController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL PADRE
    // Ruta API para crear un padre
    Route::post('/padre', [padreController::class, 'store']);

    // Ruta API para llamar a todos los padres
    Route::get('/padre', [padreController::class, 'index']);

    // Ruta API para llamar a un padre especifco
    // Route::get('/padre/{id_padre}', [padreController::class, 'show']); PARA AMBBOS ROLES

    // Ruta API para modificar la informacion de un padre
    // Route::put('/padre/{id_padre}', [padreController::class, 'update']); PARA AMBBOS ROLES

    // Ruta API para eliminiar a un padre
    Route::delete('/padre/{id_padre}', [padreController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL HIJO
    // Ruta API para crear un hijo
    // Route::post('/hijo', [hijoController::class, 'store']); PARA AMBBOS ROLES

    // Ruta API para llamar a todos los hijos
    Route::get('/hijo', [hijoController::class, 'index']);

    // // Ruta API para llamar a un hijo especifco
    // Route::get('/hijo/{id_hijo}', [hijoController::class, 'show']); PARA AMBBOS ROLES

    // // Ruta API para modificar la informacion de un hijo
    // Route::put('/hijo/{id_hijo}', [hijoController::class, 'update']); PARA AMBBOS ROLES

    // // Ruta API para eliminiar a un hijo
    // Route::delete('/hijo/{id_hijo}', [hijoController::class, 'destroy']); PARA AMBBOS ROLES
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL PRECONSULTA
    // Ruta API para crear una preconsulta
    // Route::post('/preconsulta', [preconsultaController::class, 'store']); PARA AMBBOS ROLES

    // Ruta API para llamar a todos las preconsulta
    Route::get('/preconsulta', [preconsultaController::class, 'index']);

    // Ruta API para llamar a una preconsulta especifco
    //Route::get('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'show']); PARA AMBBOS ROLES

    // Ruta API para modificar la informacion de una preconsulta
    //Route::put('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'update']); PARA AMBBOS ROLES

    // Ruta API para eliminiar a una preconsulta
    Route::delete('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA LA HISTORIA CLINICA
    // Ruta API para crear una historia clinica
    Route::post('/historiaclinica', [historiaclinicaController::class, 'store']);

    // Ruta API para llamar a todos las historia clinica
    Route::get('/historiaclinica', [historiaclinicaController::class, 'index']);

    // Ruta API para llamar a una Historia Clinica especifca
    //Route::get('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'show']);

    // Ruta API para modificar la informacion de una historia clinica
    Route::put('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'update']);

    // Ruta API para eliminiar una historia clinica
    Route::delete('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'destroy']);
});




// // Esta ruta Api contiene un grupo de rutas que van a estar protegidas por autenticacion
// Route::middleware('auth:api')->group(function () {
//         Route::get('/usuario', [usuarioController::class, 'index']);
//         Route::post('/logout', [loginController::class, 'logout']);
// });


// // RUTAS PARA EL REGISTRO E INICIO DE SESION
// Route::post('/registrarse', [loginController::class, 'registrarse']);



// // RUTAS PARA EL USUARIO
// // Ruta API para llamar a todos los usuarios
// //Route::get('/usuario', [usuarioController::class, 'index']);


// // Ruta API para llamar a un Usuario especifco
// Route::get('/usuario/{id_usuario}', [usuarioController::class, 'show']);

// // Ruta API para crear un usuario
// Route::post('/usuario', [usuarioController::class, 'store']);

// // Ruta API para modificar la informacion de un usuario
// Route::put('/usuario/{id_usuario}', [usuarioController::class, 'update']);

// // Ruta API para eliminiar a un usuario
// Route::delete('/usuario/{id_usuario}', [usuarioController::class, 'destroy']);