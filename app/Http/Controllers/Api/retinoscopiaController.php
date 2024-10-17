<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Retinoscopia con la siguiente direccion
use App\Models\Retinoscopia;

// Importamos el modelo de la historia clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class retinoscopiaController extends Controller
{
    // Funcion para llamar a todos las Retinoscopia del sistema 
    public function index(){

        // de esta manera buscamos todos las Retinoscopia del sistema y los pasamos a la variable siguiente
        $retinoscopia = Retinoscopia::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($retinoscopia->isEmpty()){
            return response()->json(['mensaje' => 'no hay Retinoscopia registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $retinoscopia. El 200 inidica que todo salio bien
        return response()->json($retinoscopia, 200);
    }

    // Funcion para almacenar las Retinoscopia dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  => 'required',
            'retino_tecnica'    => 'required|string|max:150',
            'retino_ciclople'   => 'required|string|max:150',
            'retino_refrac_od'  => 'required|string|max:150',
            'retino_subjet_od'  => 'required|string|max:150',
            'retino_final_od'   => 'required|string|max:150',
            'retino_refrac_os'  => 'required|string|max:150',
            'retino_subjet_os'  => 'required|string|max:150',
            'retino_final_os'   => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Retinoscopia',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Retinoscopia validando que los datos que vamos a agregar existan
        $retinoscopia = Retinoscopia::create([
            'id_historia'       => $request->historia_clinica,
            'retino_tecnica'    => $request->retino_tecnica,
            'retino_ciclople'   => $request->retino_ciclople,
            'retino_refrac_od'  => $request->retino_refrac_od,
            'retino_subjet_od'  => $request->retino_subjet_od,
            'retino_final_od'   => $request->retino_final_od,
            'retino_refrac_os'  => $request->retino_refrac_os,
            'retino_subjet_os'  => $request->retino_subjet_os,
            'retino_final_os'   => $request->retino_final_os
        ]);

        // aqui validamos si se puedo crear la Retinoscopia, en caso de que este vacia, no se deberia haber guardado
        if(!$retinoscopia) {
            $data = [
                'mensaje' => 'Error al crear la Retinoscopia',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Retinoscopia que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'retinoscopia' => $retinoscopia,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Retinoscopia especifico
    public function show($id){
        
        // Aqui se busca la Retinoscopia por la primaria que le estamos mandando como variable $id
        $retinoscopia = Retinoscopia::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$retinoscopia){
            $data = [
                'mensaje' => 'No se encontro la Retinoscopia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Retinoscopia fue encontrado lo colocara dentro de esta variable
        $data = [
            'retinoscopia' => $retinoscopia,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Retinoscopia
    public function destroy($id){

        // Aqui se busca la Retinoscopia por la primaria que le estamos mandando como variable $id
        $retinoscopia = Retinoscopia::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$retinoscopia){
            $data = [
                'mensaje' => 'No se encontro la Retinoscopia para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Retinoscopia encontrado 
        $retinoscopia->delete();

        // si la Retinoscopia fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La retinoscopia fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Retinoscopia
    public function update( Request $request, $id) {

        // Aqui se busca la Retinoscopia por la primaria que le estamos mandando como variable $id
        $retinoscopia = Retinoscopia::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$retinoscopia){
            $data = [
                'mensaje' => 'No se encontro la Retinoscopia para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'retino_tecnica'    => 'sometimes|string|max:150',
            'retino_ciclople'   => 'sometimes|string|max:150',
            'retino_refrac_od'  => 'sometimes|string|max:150',
            'retino_subjet_od'  => 'sometimes|string|max:150',
            'retino_final_od'   => 'sometimes|string|max:150',
            'retino_refrac_os'  => 'sometimes|string|max:150',
            'retino_subjet_os'  => 'sometimes|string|max:150',
            'retino_final_os'   => 'sometimes|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Retinoscopia edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'retino_tecnica'    => $datosvalidados['retino_tecnica'] ?? $retinoscopia->retino_tecnica,
            'retino_ciclople'   => $datosvalidados['retino_ciclople'] ?? $retinoscopia->retino_ciclople,
            'retino_refrac_od'  => $datosvalidados['retino_refrac_od'] ?? $retinoscopia->retino_refrac_od,
            'retino_subjet_od'  => $datosvalidados['retino_subjet_od'] ?? $retinoscopia->retino_subjet_od,
            'retino_final_od'   => $datosvalidados['retino_final_od'] ?? $retinoscopia->retino_final_od,
            'retino_refrac_os'  => $datosvalidados['retino_refrac_os'] ?? $retinoscopia->retino_refrac_os,
            'retino_subjet_os'  => $datosvalidados['retino_subjet_os'] ?? $retinoscopia->retino_subjet_os,
            'retino_final_os'   => $datosvalidados['retino_final_os'] ?? $retinoscopia->retino_final_os
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $retinoscopia->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $retinoscopia->save();

        // si la Retinoscopia fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Retinoscopia fue actualizado',
            'retinoscopia' => $retinoscopia,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // Funcion para buscar todas las Retinoscopias x historia clinica
    public function traerretinoscopiashistoriaclinica($id){
        // Aqui se busca la historia clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la historia clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Buscamos dentro de la tabla todos los registros que tengan este id
        $todasretinoscopiasxhistoria = Retinoscopia::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if ($todasretinoscopiasxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todasretinoscopiasxhistoria, 200);
    }


    // funcion para traer los registros de Retinoscopias mas recientes deacuerdo al id de la historia clinica
    public function traerretinoscopiamasreciente($id){
        // Aqui se busca la historia clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la historia clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Buscamos dentro de la tabla la historia clinica mas reciente por id y fecha de insercion
        $registroreciente = Retinoscopia::where('id_historia', $id)
                                        ->latest('created_at')->first();

        // Validamos si la variable con la data esta vacia
        if (!$registroreciente){
            $data = [
                'mensaje' => 'no hay registros recientes con esta historia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($registroreciente, 200);
    }
}
