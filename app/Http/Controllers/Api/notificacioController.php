<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificaciones;

class notificacioController extends Controller
{   
    public function index(){
        // de esta manera buscamos todos los foros del sistema y los pasamos a la variable siguiente
        $notificaciones = Notificaciones::orderBy('created_at', 'desc')->limit(2)
        ->get();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($notificaciones->isEmpty()){
            $data = [
                'notificaciones' => $notificaciones,
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // aqui colocamos en la variable $data el foro que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'notificacion' => $notificaciones,
            'status' => 200
        ];

        // este return devuelve todo lo que contiene la variable de $foros. El 200 inidica que todo salio bien
        return response()->json($data, 200);
    }
    
}
