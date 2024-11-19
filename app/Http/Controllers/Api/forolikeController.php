<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foro_like;
use Illuminate\Http\Request;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

// Importamos el modelo de hijos con la siguiente direccion
use App\Models\User;
use App\Models\Foro;

class forolikeController extends Controller
{
    // funcion para manejar los likes de los usuarios
    public function manejarlikes (Request $request) {

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'usuario'   => 'required',
            'foro'      => 'required',
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos foro',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 200);
        }

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $usuario = User::where('documento', $request->usuario)->first();
        
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro al usuario',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $foro = Foro::find($request->foro);
        
        if (!$foro){
            $data = [
                'mensaje' => 'No se encontro el foro',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // verificamos que no haya un dato repetido con la siguiente consulta
        $likeExists = Foro_like::where('id_usuario', $usuario->id)->where('id_foro', $foro->id)->exists();

        // si la hay hara esto
        if ($likeExists) {
            $data = [
                'mensaje' => 'Ya has dado like a este foro',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        // intentamos agregar el registro de foro
        $like = Foro_like::create([
            'id_usuario'    => $usuario->id,
            'id_foro'       => $foro->id,
        ]);

        // si no se pudo agregar hara esto
        if(!$like) {
            $data = [
                'mensaje' => 'No se puedo agrgar el like',
                'status' => 500
            ];
            return response()->json($data, 200);
        }

        // en caso de que se haya agregado 
        $data = [
            'mensaje' => 'Like agregado',
            'status' => 201
        ];

        // retornamos el mensaje con la variable anterior si todo sale bien
        return response()->json($data, 200);

    }

}
