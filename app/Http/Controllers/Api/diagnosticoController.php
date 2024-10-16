<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de diagnostico con la siguiente direccion
use App\Models\Diagnostico;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class diagnosticoController extends Controller
{
    // Funcion para llamar a todos los Cogidos del sistema
    public function index(){

        // de esta manera buscamos todos los Diagnosticos del sistema y los pasamos a la variable siguiente
        $diagnostico = Diagnostico::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($diagnostico->isEmpty()){
            return response()->json(['mensaje' => 'no hay diagnosticos registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $diagnostico. El 200 inidica que todo salio bien
        return response()->json($diagnostico, 200);
    }

    // Funcion para alamacenar los Diagnosticos dentro de la base de datos
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre'        => 'required|string',
            'descripcion'   => 'required|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos diagnostico',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Diagnostico validando que los datos que vamos a agregar existan
        $diagnostico = Diagnostico::create([
            'codigo'        => $request->nombre,
            'descripcion'   => $request->descripcion
        ]);

        // aqui validamos si se puedo crear el Diagnostico, en caso de que este vacia, no se deberia haber guardado
        if(!$diagnostico) {
            $data = [
                'mensaje' => 'Error al crear el Usuario',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el diagnostico que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'diagnostico' => $diagnostico,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Diagnostico especifico
    public function show($id){
        
        // Aqui se busca el Diagnostico por la primaria que le estamos mandando como variable $id
        $diagnostico = Diagnostico::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diagnostico){
            $data = [
                'mensaje' => 'No se encontro el Diagnostico',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Diagnostico fue encontrado lo colocara dentor de esta variable
        $data = [
            'diagnostico' => $diagnostico,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Diagnostico
    public function destroy($id){

        // Aqui se busca el Diagnostico por la primaria que le estamos mandando como variable $id
        $diagnostico = Diagnostico::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$diagnostico){
            $data = [
                'mensaje' => 'No se encontro el Diagnostico para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Diagnostico encontrado 
        $diagnostico->delete();

        // si el Diagnostico fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Diagnostico
    public function update( Request $request, $id) {

        // Aqui se busca el Diagnostico por la primaria que le estamos mandando como variable $id
        $diagnostico = Diagnostico::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diagnostico){
            $data = [
                'mensaje' => 'No se encontro el Diagnostico para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre'        => 'sometimes|string',
            'descripcion'   => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos diagnostico edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'codigo'        => $datosvalidados['nombre'] ?? $diagnostico->codigo,
            'descripcion'   => $datosvalidados['descripcion'] ?? $diagnostico->descripcion
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $diagnostico->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $diagnostico->save();

        // si el Diagnostico fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico fue actualizado',
            'diagnostico' => $diagnostico,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
