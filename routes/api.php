<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importamos el controlador en donde se encuentra
use App\Http\Controllers\Api\usuarioController;
use App\Http\Controllers\Api\loginController;
use App\Http\Controllers\Api\diagnosticoController;
use App\Http\Controllers\Api\foroController;
use App\Http\Controllers\Api\padreController;
use App\Http\Controllers\Api\hijoController;
use App\Http\Controllers\Api\preconsultaController;
use App\Http\Controllers\Api\historiaclinicaController;
use App\Http\Controllers\Api\agudezavisualController;
use App\Http\Controllers\Api\alineamientomotorController;
use App\Http\Controllers\Api\antecedentevisualController;
use App\Http\Controllers\Api\diagnosticohistoriaclinicaController;
use App\Http\Controllers\Api\duccionController;
use App\Http\Controllers\Api\exploracionexternoController;
use App\Http\Controllers\Api\motalidadocularController;
use App\Http\Controllers\Api\oftalmoscopiaController;
use App\Http\Controllers\Api\retinoscopiaController;
use App\Http\Controllers\Api\versionController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Ruta API para llamar a todos los usuarios -- comentado por ahora
// Route::get('/usuario', function () {
//     return 'Usuarios del sistema';
// });

// RUTAS PARA EL REGISTRO E INICIO DE SESION


// Ruta iniciar sesion y generar el token
Route::group([
    'prefix' => 'auth'
], function(){

    Route::post('/login', [loginController::class, 'login']);
    Route::post('/registrarse', [loginController::class, 'registrarse']);
});



Route::get('/promediomespreconsulta/{id_hijo}', [preconsultaController::class, 'promediomespreconsulta']);

Route::get('/prueba', [preconsultaController::class, 'validarrellenarpreconsulta']);


// Esta ruta Api contiene un grupo de rutas que van a estar protegidas por autenticacion
Route::middleware('auth:api')->group(function () {
    // Ruta para cerrar la sesión
    Route::post('/logout', [loginController::class, 'logout']);
});

// ROL 1 ADMIN Y ROL 2 USUARIO NORMAL

//Route::middleware(['auth:api', 'rol:1,2'])->group(function () {
    // RUTAS PARA EL FORO
    // Ruta API para llamar a todos los foros
    Route::get('/foro', [foroController::class, 'index']);


    // RUTAS PARA EL PADRE
    // Ruta API para llamar a un padre especifco
    //Route::get('/padre/{id_padre}', [padreController::class, 'show']);

    // Ruta API para modificar la informacion de un padre
    //Route::put('/padre/{id_padre}', [padreController::class, 'update']);

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


    // // RUTAS PARA EL PRECONSULTA
    // // Ruta API para crear una preconsulta
    // Route::post('/preconsulta', [preconsultaController::class, 'store']);

    // // Ruta API para llamar a una preconsulta especifica
    // Route::get('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'show']);

    // // Ruta API para modificar la informacion de una preconsulta
    // Route::put('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'update']);

    // // Ruta API para llamar solamente a las preconsultas de un hijo
    // Route::get('/preconsdelhijo/{id_hijo}', [preconsultaController::class, 'preconsdelhijo']);


    // RUTAS A HISTORIA CLINICA
    // Ruta API para llamar a una Historia Clinica especifica
    Route::get('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'show']);

    //Ruta API para llamar solamente a las historias clinicas del hijo
    Route::get('/historiasdelhijo/{id_hijo}', [historiaclinicaController::class, 'historiasdelhijo']);
//});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A AGUDEZA VISUAL
    // Ruta API para crear una agudeza visual
    Route::post('/agudezavisual', [agudezavisualController::class, 'store']);

    // Ruta API para llamar a todos las agudeza visual
    Route::get('/agudezavisual', [agudezavisualController::class, 'index']);

    // Ruta API para llamar a una agudeza visual especifica
    Route::get('/agudezavisual/{cod_agude_visua}', [agudezavisualController::class, 'show']);

    // Ruta API para modificar la informacion de un usuario
    Route::put('/agudezavisual/{cod_agude_visua}', [agudezavisualController::class, 'update']);

    // Ruta API para eliminiar a un usuario
    Route::delete('/agudezavisual/{cod_agude_visua}', [agudezavisualController::class, 'destroy']);
}); 
    
Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A ALINEAMIENTO MOTOR
    // Ruta API para crear un alineamiento motor
    Route::post('/alineamientomotor', [alineamientomotorController::class, 'store']);

    // Ruta API para llamar a todos los alineamiento motor
    Route::get('/alineamientomotor', [alineamientomotorController::class, 'index']);

    // Ruta API para llamar a un alineamiento motor especifco
    Route::get('/alineamientomotor/{cod_alinea_motor}', [alineamientomotorController::class, 'show']);

    // Ruta API para modificar la informacion de un alineamiento motor
    Route::put('/alineamientomotor/{cod_alinea_motor}', [alineamientomotorController::class, 'update']);

    // Ruta API para eliminiar a un alineamiento motor
    Route::delete('/alineamientomotor/{cod_alinea_motor}', [alineamientomotorController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A ANTECEDENTE VISUAL
    // Ruta API para crear un Antecedente visual
    Route::post('/antecedetevisual', [antecedentevisualController::class, 'store']);

    // Ruta API para llamar a todos los Antecedente visual
    Route::get('/antecedetevisual', [antecedentevisualController::class, 'index']);

    // Ruta API para llamar a un Antecedente visual especifco
    Route::get('/antecedetevisual/{cod_antece_visua}', [antecedentevisualController::class, 'show']);

    // Ruta API para modificar la informacion de un Antecedente visual
    Route::put('/antecedetevisual/{cod_antece_visua}', [antecedentevisualController::class, 'update']);

    // Ruta API para eliminiar a un Antecedente visual
    Route::delete('/antecedetevisual/{cod_antece_visua}', [antecedentevisualController::class, 'destroy']);
});

Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A DIAGNOSTICO X HISTORIA CLINICA
    // Ruta API para crear un Diagnostico x historia clinica
    Route::post('/diaghistoriaclinica', [diagnosticohistoriaclinicaController::class, 'store']);

    // Ruta API para llamar a todos los Diagnostico x historia clinica
    Route::get('/diaghistoriaclinica', [diagnosticohistoriaclinicaController::class, 'index']);

    // Ruta API para llamar a un Diagnostico x historia clinica especifco
    Route::get('/diaghistoriaclinica/{cod_diag_his}', [diagnosticohistoriaclinicaController::class, 'show']);

    // Ruta API para modificar la informacion de un Diagnostico x historia clinica
    Route::put('/diaghistoriaclinica/{cod_diag_his}', [diagnosticohistoriaclinicaController::class, 'update']);

    // Ruta API para eliminiar a un Diagnostico x historia clinica
    Route::delete('/diaghistoriaclinica/{cod_diag_his}', [diagnosticohistoriaclinicaController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A DUCCIONES
    // Ruta API para crear una Duccion
    Route::post('/duccion', [duccionController::class, 'store']);

    // Ruta API para llamar a todos las Ducciones
    Route::get('/duccion', [duccionController::class, 'index']);

    // Ruta API para llamar a una Duccion especifca
    Route::get('/duccion/{cod_ducciones}', [duccionController::class, 'show']);

    // Ruta API para modificar la informacion de una Duccion
    Route::put('/duccion/{cod_ducciones}', [duccionController::class, 'update']);

    // Ruta API para eliminiar a una Duccion
    Route::delete('/duccion/{cod_ducciones}', [duccionController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A EXPLORACION DE EXTERNO
    // Ruta API para crear una Exploracion de externo
    Route::post('/exploexterno', [exploracionexternoController::class, 'store']);

    // Ruta API para llamar a todos las Exploracion de externo
    Route::get('/exploexterno', [exploracionexternoController::class, 'index']);

    // Ruta API para llamar a una Exploracion de externo especifco
    Route::get('/exploexterno/{cod_explo_exter}', [exploracionexternoController::class, 'show']);

    // Ruta API para modificar la informacion de una Exploracion de externo
    Route::put('/exploexterno/{cod_explo_exter}', [exploracionexternoController::class, 'update']);

    // Ruta API para eliminiar a una Exploracion de externo
    Route::delete('/exploexterno/{cod_explo_exter}', [exploracionexternoController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A MOTALIDAD OCULAR
    // Ruta API para crear una Motalidad ocular
    Route::post('/motaliocular', [motalidadocularController::class, 'store']);

    // Ruta API para llamar a todos las Motalidad ocular
    Route::get('/motaliocular', [motalidadocularController::class, 'index']);

    // Ruta API para llamar a una Motalidad ocular especifco
    Route::get('/motaliocular/{cod_motali_ocular}', [motalidadocularController::class, 'show']);

    // Ruta API para modificar la informacion de una Motalidad ocular
    Route::put('/motaliocular/{cod_motali_ocular}', [motalidadocularController::class, 'update']);

    // Ruta API para eliminiar a una Motalidad ocular
    Route::delete('/motaliocular/{cod_motali_ocular}', [motalidadocularController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A OFTALMOSCOPIA
    // Ruta API para crear una Oftalmoscopia
    Route::post('/oftalmoscopia', [oftalmoscopiaController::class, 'store']);

    // Ruta API para llamar a todos las Oftalmoscopia
    Route::get('/oftalmoscopia', [oftalmoscopiaController::class, 'index']);

    // Ruta API para llamar a una Oftalmoscopia especifco
    Route::get('/oftalmoscopia/{cod_oftalmoscopia}', [oftalmoscopiaController::class, 'show']);

    // Ruta API para modificar la informacion de una Oftalmoscopia
    Route::put('/oftalmoscopia/{cod_oftalmoscopia}', [oftalmoscopiaController::class, 'update']);

    // Ruta API para eliminiar a una Oftalmoscopia
    Route::delete('/oftalmoscopia/{cod_oftalmoscopia}', [oftalmoscopiaController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A RETINOSCOPIA
    // Ruta API para crear una Retinoscopia
    Route::post('/retinoscopia', [retinoscopiaController::class, 'store']);

    // Ruta API para llamar a todos las Retinoscopia
    Route::get('/retinoscopia', [retinoscopiaController::class, 'index']);

    // Ruta API para llamar a una Retinoscopiao especifco
    Route::get('/retinoscopia/{cod_retinoscopia}', [retinoscopiaController::class, 'show']);

    // Ruta API para modificar la informacion de una Retinoscopia
    Route::put('/retinoscopia/{cod_retinoscopia}', [retinoscopiaController::class, 'update']);

    // Ruta API para eliminiar a una Retinoscopia
    Route::delete('/retinoscopia/{cod_retinoscopia}', [retinoscopiaController::class, 'destroy']);
});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS A VERSION
    // Ruta API para crear una Version
    Route::post('/version', [versionController::class, 'store']);

    // Ruta API para llamar a todos las Version
    Route::get('/version', [versionController::class, 'index']);

    // Ruta API para llamar a una Version especifco
    Route::get('/version/{cod_versiones}', [versionController::class, 'show']);

    // Ruta API para modificar la informacion de una Version
    Route::put('/version/{cod_versiones}', [versionController::class, 'update']);

    // Ruta API para eliminiar a una Version
    Route::delete('/version/{cod_versiones}', [versionController::class, 'destroy']);
});


//Route::middleware(['auth:api', 'rol:1'])->group(function () {
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
//});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA LOS DIAGNOSTICOS
    // Ruta API para crear un diagnostico
    Route::post('/diagnostico', [diagnosticoController::class, 'store']);

    // Ruta API para llamar a todos los diagnostico
    Route::get('/diagnostico', [diagnosticoController::class, 'index']);

    // Ruta API para llamar a un diagnostico especifco
    Route::get('/diagnostico/{cod_diagnostico}', [diagnosticoController::class, 'show']);

    // Ruta API para modificar la informacion de un diagnostico
    Route::put('/diagnostico/{cod_diagnostico}', [diagnosticoController::class, 'update']);

    // Ruta API para eliminiar un diagnostico
    Route::delete('/diagnostico/{cod_diagnostico}', [diagnosticoController::class, 'destroy']);
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


//Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL PADRE
    // Ruta API para crear un padre
    //Route::post('/padre', [padreController::class, 'store']);

    // Ruta API para llamar a todos los padres
    //Route::get('/padre', [padreController::class, 'index']);

    // Ruta API para llamar a un padre especifco
    // Route::get('/padre/{id_padre}', [padreController::class, 'show']); PARA AMBBOS ROLES

    // Ruta API para modificar la informacion de un padre
    // Route::put('/padre/{id_padre}', [padreController::class, 'update']); PARA AMBBOS ROLES

    // Ruta API para eliminiar a un padre
    //Route::delete('/padre/{id_padre}', [padreController::class, 'destroy']);
//});


//Route::middleware(['auth:api', 'rol:1'])->group(function () {
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
//});


//Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA EL PRECONSULTA
    // Ruta API para crear una preconsulta
    Route::post('/preconsulta', [preconsultaController::class, 'store']); //PARA AMBBOS ROLES

    // Ruta API para llamar a todos las preconsulta
    Route::get('/preconsulta', [preconsultaController::class, 'index']);

    // Ruta API para llamar a una preconsulta especifco
    Route::get('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'show']); //PARA AMBBOS ROLES

    // Ruta API para modificar la informacion de una preconsulta
    Route::put('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'update']); //PARA AMBBOS ROLES

    // Ruta API para eliminiar a una preconsulta
    Route::delete('/preconsulta/{cod_preconsul}', [preconsultaController::class, 'destroy']);
//});


Route::middleware(['auth:api', 'rol:1'])->group(function () {
    // RUTAS PARA LA HISTORIA CLINICA
    // Ruta API para crear una historia clinica
    Route::post('/historiaclinica', [historiaclinicaController::class, 'store']);

    // Ruta API para llamar a todos las historia clinica
    Route::get('/historiaclinica', [historiaclinicaController::class, 'index']);

    // Ruta API para llamar a una Historia Clinica especifica
    //Route::get('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'show']);

    // Ruta API para modificar la informacion de una historia clinica
    Route::put('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'update']);

    // Ruta API para eliminiar una historia clinica
    Route::delete('/historiaclinica/{cod_historia}', [historiaclinicaController::class, 'destroy']);
});