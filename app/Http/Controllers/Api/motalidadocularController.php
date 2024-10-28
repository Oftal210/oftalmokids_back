<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Motalidad ocular con la siguiente direccion
use App\Models\Motalidad_ocular;

// Importamos el modelo de la historia clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class motalidadocularController extends Controller
{
    // Funcion para llamar a todos las Motalidad ocular del sistema 
    public function index(){

        // de esta manera buscamos todos las Motalidad ocular del sistema y los pasamos a la variable siguiente
        $motaliocular = Motalidad_ocular::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($motaliocular->isEmpty()){
            return response()->json(['mensaje' => 'no hay Motalidad ocular registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $motaliocular. El 200 inidica que todo salio bien
        return response()->json($motaliocular, 200);
    }

    // Funcion para almacenar las Motalidad ocular dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  => 'required',
            'mo_seguimiento_od' => 'required|string|max:150',
            'mo_sacadicos_od'   => 'required|string|max:150',
            'mo_seguimiento_os' => 'required|string|max:150',
            'mo_sacadicos_os'   => 'required|string|max:150',
            'mo_seguimiento_ao' => 'required|string|max:150', 
            'mo_sacadicos_ao'   => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Motalidad ocular',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Motalidad ocular validando que los datos que vamos a agregar existan
        $motaliocular = Motalidad_ocular::create([
            'id_historia'       => $request->historia_clinica,
            'mo_seguimiento_od' => $request->mo_seguimiento_od,
            'mo_sacadicos_od'   => $request->mo_sacadicos_od,
            'mo_seguimiento_os' => $request->mo_seguimiento_os,
            'mo_sacadicos_os'   => $request->mo_sacadicos_os,
            'mo_seguimiento_ao' => $request->mo_seguimiento_ao, 
            'mo_sacadicos_ao'   => $request->mo_sacadicos_ao
            
        ]);

        // aqui validamos si se puedo crear la Motalidad ocular, en caso de que este vacia, no se deberia haber guardado
        if(!$motaliocular) {
            $data = [
                'mensaje' => 'Error al crear la Motalidad ocular',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Motalidad ocular que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'motalidad_ocular' => $motaliocular,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Motalidad ocular especifico
    public function show($id){
        
        // Aqui se busca la Motalidad ocular por la primaria que le estamos mandando como variable $id
        $motaliocular = Motalidad_ocular::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$motaliocular){
            $data = [
                'mensaje' => 'No se encontro la Motalidad ocular',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Motalidad ocular fue encontrado lo colocara dentro de esta variable
        $data = [
            'motalidad_ocular' => $motaliocular,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Motalidad ocular
    public function destroy($id){

        // Aqui se busca la Motalidad ocular por la primaria que le estamos mandando como variable $id
        $motaliocular = Motalidad_ocular::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$motaliocular){
            $data = [
                'mensaje' => 'No se encontro la Motalidad ocular para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Motalidad ocular encontrado 
        $motaliocular->delete();

        // si la Motalidad ocular fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Motalidad ocular fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Motalidad ocular
    public function update( Request $request, $id) {

        // Aqui se busca la Motalidad ocular por la primaria que le estamos mandando como variable $id
        $motaliocular = Motalidad_ocular::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$motaliocular){
            $data = [
                'mensaje' => 'No se encontro la Motalidad ocular para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'mo_seguimiento_od' => 'sometimes|string|max:150',
            'mo_sacadicos_od'   => 'sometimes|string|max:150',
            'mo_seguimiento_os' => 'sometimes|string|max:150',
            'mo_sacadicos_os'   => 'sometimes|string|max:150',
            'mo_seguimiento_ao' => 'sometimes|string|max:150', 
            'mo_sacadicos_ao'   => 'sometimes|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Motalidad ocular edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'mo_seguimiento_od' => $datosvalidados['mo_seguimiento_od'] ?? $motaliocular->mo_seguimiento_od,
            'mo_sacadicos_od' => $datosvalidados['mo_sacadicos_od'] ?? $motaliocular->mo_sacadicos_od,
            'mo_seguimiento_os' => $datosvalidados['mo_seguimiento_os'] ?? $motaliocular->mo_seguimiento_os,
            'mo_sacadicos_os' => $datosvalidados['mo_sacadicos_os'] ?? $motaliocular->mo_sacadicos_os,
            'mo_seguimiento_ao' => $datosvalidados['mo_seguimiento_ao'] ?? $motaliocular->mo_seguimiento_ao,
            'mo_sacadicos_ao' => $datosvalidados['mo_sacadicos_ao'] ?? $motaliocular->mo_sacadicos_ao,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $motaliocular->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $motaliocular->save();

        // si la Motalidad ocular fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Motalidad ocular oculario fue actualizado',
            'motalidad_ocular' => $motaliocular,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // Funcion para buscar todas las motalidades oculares x historia clinica
    public function traermotalidadeshistoriaclinica($id){
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
        $todasmotalidadesxhistoria = Motalidad_ocular::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if ($todasmotalidadesxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todasmotalidadesxhistoria, 200);
    }


    // funcion para traer los registros de motalidades visuales mas recientes deacuerdo al id de la historia clinica
    public function traermotalidadmasreciente($id){
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
        $registroreciente = Motalidad_ocular::where('id_historia', $id)
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
