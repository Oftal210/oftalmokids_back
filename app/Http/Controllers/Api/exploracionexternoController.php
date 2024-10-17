<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Exploracion de externo con la siguiente direccion
use App\Models\Exploracion_externo;

// Importamos el modelo de la historia clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class exploracionexternoController extends Controller
{
    // Funcion para llamar a todos los Exploracion de externo del sistema 
    public function index(){

        // de esta manera buscamos todos los Exploracion de externo del sistema y los pasamos a la variable siguiente
        $exploexter = Exploracion_externo::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($exploexter->isEmpty()){
            return response()->json(['mensaje' => 'no hay "Exploracion de externo" registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $exploexter. El 200 inidica que todo salio bien
        return response()->json($exploexter, 200);
    }

    // Funcion para almacenar los Exploracion de externo dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  => 'required',
            'explo_exter_od'    => 'required|string|max:150',
            'explo_exter_os'    => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Exploracion de externo',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Exploracion de externo validando que los datos que vamos a agregar existan
        $exploexter = Exploracion_externo::create([
            'id_historia'       => $request->historia_clinica,
            'explo_exter_od'    => $request->explo_exter_od,
            'explo_exter_os'    => $request->explo_exter_os
            
        ]);

        // aqui validamos si se puedo crear el Exploracion de externo, en caso de que este vacia, no se deberia haber guardado
        if(!$exploexter) {
            $data = [
                'mensaje' => 'Error al crear Exploracion de externo',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data, el Exploracion de externo que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'exploracion_externo' => $exploexter,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Exploracion de externo especifico
    public function show($id){
        
        // Aqui se busca el Exploracion de externo por la primaria que le estamos mandando como variable $id
        $exploexter = Exploracion_externo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$exploexter){
            $data = [
                'mensaje' => 'No se encontro Exploracion de externo',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Exploracion de externo fue encontrado lo colocara dentro de esta variable
        $data = [
            'exploracion_externo' => $exploexter,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Exploracion de externo
    public function destroy($id){

        // Aqui se busca la Exploracion de externo por la primaria que le estamos mandando como variable $id
        $exploexter = Exploracion_externo::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$exploexter){
            $data = [
                'mensaje' => 'No se encontro la Exploracion de externo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Exploracion de externo encontrado 
        $exploexter->delete();

        // si la Exploracion de externo fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Exploracion de externo fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Exploracion de externo
    public function update( Request $request, $id) {

        // Aqui se busca la Exploracion de externo por la primaria que le estamos mandando como variable $id
        $exploexter = Exploracion_externo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$exploexter){
            $data = [
                'mensaje' => 'No se encontro la Exploracion de externo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'explo_exter_od' => 'sometimes|string|max:150',
            'explo_exter_os' => 'sometimes|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Exploracion de externo edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'explo_exter_od' => $datosvalidados['explo_exter_od'] ?? $exploexter->explo_exter_od,
            'explo_exter_os' => $datosvalidados['explo_exter_os'] ?? $exploexter->explo_exter_os
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $exploexter->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $exploexter->save();

        // si la Exploracion de externo fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Exploracion de externo fue actualizado',
            'exploracion_externo' => $exploexter,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // Funcion para buscar todas las exploraciones visuales x historia clinica
    public function traerexploracioneshistoriaclinica($id){
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
        $todasagudezasxhistoria = Exploracion_externo::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if ($todasagudezasxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia 1',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todasagudezasxhistoria, 200);
    }


    // funcion para traer los registros de exploracion externo mas reciente deacuerdo al id de la historia clinica
    public function traerexploracionmasreciente($id){
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
        $registroreciente = Exploracion_externo::where('id_historia', $id)
                                               ->latest('created_at')->first();

        // Validamos si la variable con la data esta vacia
        if (!$registroreciente){
            $data = [
                'mensaje' => 'no hay registros recientes con esta historia 2',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($registroreciente, 200);
    }
}
