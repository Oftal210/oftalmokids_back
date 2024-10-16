<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Duccion con la siguiente direccion
use App\Models\Duccion;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class duccionController extends Controller
{
    // Funcion para llamar a todos las Duccion del sistema 
    public function index(){

        // de esta manera buscamos todos las Duccion del sistema y los pasamos a la variable siguiente
        $duccion = Duccion::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($duccion->isEmpty()){
            return response()->json(['mensaje' => 'no hay Ducciones registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $duccion. El 200 inidica que todo salio bien
        return response()->json($duccion, 200);
    }

    // Funcion para almacenar las Duccion dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  => 'required',
            'ducc_normal_od'    => 'required|string|max:150',
            'ducc_parecia_od'   => 'required|string|max:150',
            'ducc_paralisis_od' => 'required|string|max:150',
            'ducc_normal_os'    => 'required|string|max:150',
            'ducc_parecia_os'   => 'required|string|max:150',
            'ducc_paralisis_os' => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Duccion',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Duccion validando que los datos que vamos a agregar existan
        $duccion = Duccion::create([
            'id_historia'       => $request->historia_clinica,
            'ducc_normal_od'    => $request->ducc_normal_od,
            'ducc_parecia_od'   => $request->ducc_parecia_od,
            'ducc_paralisis_od' => $request->ducc_paralisis_od,
            'ducc_normal_os'    => $request->ducc_normal_os,
            'ducc_parecia_os'   => $request->ducc_parecia_os,
            'ducc_paralisis_os' => $request->ducc_paralisis_os,
            
        ]);

        // aqui validamos si se puedo crear la Duccion, en caso de que este vacia, no se deberia haber guardado
        if(!$duccion) {
            $data = [
                'mensaje' => 'Error al crear la Duccion',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Duccion que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'duccion' => $duccion,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Duccion especifico
    public function show($id){
        
        // Aqui se busca la Duccion por la primaria que le estamos mandando como variable $id
        $duccion = Duccion::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$duccion){
            $data = [
                'mensaje' => 'No se encontro la Duccion',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Duccion fue encontrado lo colocara dentro de esta variable
        $data = [
            'duccion' => $duccion,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Duccion
    public function destroy($id){

        // Aqui se busca la Duccion por la primaria que le estamos mandando como variable $id
        $duccion = Duccion::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$duccion){
            $data = [
                'mensaje' => 'No se encontro la Duccion para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Duccion encontrado 
        $duccion->delete();

        // si la Duccion fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Duccion fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Duccion
    public function update( Request $request, $id) {

        // Aqui se busca la Duccion por la primaria que le estamos mandando como variable $id
        $duccion = Duccion::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$duccion){
            $data = [
                'mensaje' => 'No se encontro la Duccion para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'ducc_normal_od'    => 'sometimes|string|max:150',
            'ducc_parecia_od'   => 'sometimes|string|max:150',
            'ducc_paralisis_od' => 'sometimes|string|max:150',
            'ducc_normal_os'    => 'sometimes|string|max:150',
            'ducc_parecia_os'   => 'sometimes|string|max:150',
            'ducc_paralisis_os' => 'sometimes|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos duccion edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'ducc_normal_od'    => $datosvalidados['ducc_normal_od'] ?? $duccion->ducc_normal_od,
            'ducc_parecia_od'   => $datosvalidados['ducc_parecia_od'] ?? $duccion->ducc_parecia_od,
            'ducc_paralisis_od' => $datosvalidados['ducc_paralisis_od'] ?? $duccion->ducc_paralisis_od,
            'ducc_normal_os'    => $datosvalidados['ducc_normal_os'] ?? $duccion->ducc_normal_os,
            'ducc_parecia_os'   => $datosvalidados['ducc_parecia_os'] ?? $duccion->ducc_parecia_os,
            'ducc_paralisis_os' => $datosvalidados['ducc_paralisis_os'] ?? $duccion->ducc_paralisis_os,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $duccion->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $duccion->save();

        // si la Duccion fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Duccion fue actualizado',
            'duccion' => $duccion,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
