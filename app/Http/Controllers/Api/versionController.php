<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Version con la siguiente direccion
use App\Models\Version;

// Importamos el modelo de la historia clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class versionController extends Controller
{
    // Funcion para llamar a todos las Version del sistema 
    public function index(){

        // de esta manera buscamos todos las Version del sistema y los pasamos a la variable siguiente
        $version = Version::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($version->isEmpty()){
            return response()->json(['mensaje' => 'no hay Version registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $version. El 200 inidica que todo salio bien
        return response()->json($version, 200);
    }

    // Funcion para almacenar las Version dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'      => 'required',
            'observacion_versiones' => 'required|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Version',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Version validando que los datos que vamos a agregar existan
        $version = Version::create([
            'id_historia'   => $request->historia_clinica,
            'observacion'   => $request->observacion_versiones,
        ]);

        // aqui validamos si se puedo crear la Version, en caso de que este vacia, no se deberia haber guardado
        if(!$version) {
            $data = [
                'mensaje' => 'Error al crear la Version',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data, la Version que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'version' => $version,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Version especifico
    public function show($id){
        
        // Aqui se busca la Version por la primaria que le estamos mandando como variable $id
        $version = Version::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$version){
            $data = [
                'mensaje' => 'No se encontro la Version',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Version fue encontrado lo colocara dentro de esta variable
        $data = [
            'version' => $version,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Version
    public function destroy($id){

        // Aqui se busca la Version por la primaria que le estamos mandando como variable $id
        $version = Version::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$version){
            $data = [
                'mensaje' => 'No se encontro la Version para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Version encontrado 
        $version->delete();

        // si la Version fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Version fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Version
    public function update( Request $request, $id) {

        // Aqui se busca la Version por la primaria que le estamos mandando como variable $id
        $version = Version::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$version){
            $data = [
                'mensaje' => 'No se encontro la Version para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'observacion_versiones' => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Version edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'observacion' => $datosvalidados['observacion_versiones'] ?? $version->observacion
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $version->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $version->save();

        // si la Version fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Version fue actualizado',
            'version' => $version,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    
    // Funcion para buscar todas las Versiones x historia clinica
    public function traerversioneshistoriaclinica($id){
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
        $todasversionesxhistoria = Version::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if ($todasversionesxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia 1',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todasversionesxhistoria, 200);
    }


    // funcion para traer los registros de Versiones mas recientes deacuerdo al id de la historia clinica
    public function traerversionmasreciente($id){
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
        $registroreciente = Version::where('id_historia', $id)
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
