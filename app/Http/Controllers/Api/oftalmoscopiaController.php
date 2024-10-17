<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Oftalmoscopia con la siguiente direccion
use App\Models\Oftalmoscopia;

// Importamos el modelo de la historia clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class oftalmoscopiaController extends Controller
{
    // Funcion para llamar a todos las Oftalmoscopia del sistema 
    public function index(){

        // de esta manera buscamos todos las Oftalmoscopia del sistema y los pasamos a la variable siguiente
        $oftalmoscopia = Oftalmoscopia::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($oftalmoscopia->isEmpty()){
            return response()->json(['mensaje' => 'no hay Oftalmoscopia registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $oftalmoscopia. El 200 inidica que todo salio bien
        return response()->json($oftalmoscopia, 200);
    }

    // Funcion para almacenar las Oftalmoscopia dentro de la base de datos
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  => 'required',
            'medi_refrin_od'    => 'required|string|max:150',
            'refle_fovea_od'    => 'required|string|max:150',
            'papila_od'         => 'required|string|max:150',
            'excav_fisio_od'    => 'required|string|max:150',
            'profundidad_od'    => 'required|string|max:150',
            'vasos_od'          => 'required|string|max:150',
            'rela_arte_od'      => 'required|string|max:150',
            'macula_od'         => 'required|string|max:150',
            'reti_perif_od'     => 'required|string|max:150',
            'medi_refrin_os'    => 'required|string|max:150',
            'refle_fovea_os'    => 'required|string|max:150',
            'papila_os'         => 'required|string|max:150',
            'excav_fisio_os'    => 'required|string|max:150',
            'profundidad_os'    => 'required|string|max:150',
            'vasos_os'          => 'required|string|max:150',
            'rela_arte_os'      => 'required|string|max:150',
            'macula_os'         => 'required|string|max:150',
            'reti_perif_os'     => 'required|string|max:150'

        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Oftalmoscopia',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Oftalmoscopia validando que los datos que vamos a agregar existan
        $oftalmoscopia = Oftalmoscopia::create([
            'id_historia'       => $request->historia_clinica,
            'medi_refrin_od'    => $request->medi_refrin_od,
            'refle_fovea_od'    => $request->refle_fovea_od,
            'papila_od'         => $request->papila_od,
            'excav_fisio_od'    => $request->excav_fisio_od,
            'profundidad_od'    => $request->profundidad_od,
            'vasos_od'          => $request->vasos_od,
            'rela_arte_od'      => $request->rela_arte_od,
            'macula_od'         => $request->macula_od,
            'reti_perif_od'     => $request->reti_perif_od,
            'medi_refrin_os'    => $request->medi_refrin_os,
            'refle_fovea_os'    => $request->refle_fovea_os,
            'papila_os'         => $request->papila_os,
            'excav_fisio_os'    => $request->excav_fisio_os,
            'profundidad_os'    => $request->profundidad_os,
            'vasos_os'          => $request->vasos_os,
            'rela_arte_os'      => $request->rela_arte_os,
            'macula_os'         => $request->macula_os,
            'reti_perif_os'     => $request->reti_perif_os
        ]);

        // aqui validamos si se puedo crear la Oftalmoscopia, en caso de que este vacia, no se deberia haber guardado
        if(!$oftalmoscopia) {
            $data = [
                'mensaje' => 'Error al crear la Oftalmoscopia',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Oftalmoscopia que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'oftalmoscopia' => $oftalmoscopia,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una oftalmoscopia especifico
    public function show($id){
        
        // Aqui se busca la Oftalmoscopia por la primaria que le estamos mandando como variable $id
        $oftalmoscopia = Oftalmoscopia::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$oftalmoscopia){
            $data = [
                'mensaje' => 'No se encontro la Oftalmoscopia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la oftalmoscopia fue encontrado lo colocara dentro de esta variable
        $data = [
            'oftalmoscopia' => $oftalmoscopia,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Oftalmoscopia
    public function destroy($id){

        // Aqui se busca la Oftalmoscopia por la primaria que le estamos mandando como variable $id
        $oftalmoscopia = Oftalmoscopia::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$oftalmoscopia){
            $data = [
                'mensaje' => 'No se encontro la Oftalmoscopia para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Oftalmoscopia encontrado 
        $oftalmoscopia->delete();

        // si el Oftalmoscopia fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Oftalmoscopia fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una oftalmoscopia
    public function update( Request $request, $id) {

        // Aqui se busca la oftalmoscopia por la primaria que le estamos mandando como variable $id
        $oftalmoscopia = Oftalmoscopia::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$oftalmoscopia){
            $data = [
                'mensaje' => 'No se encontro la Oftalmoscopia para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'medi_refrin_od'    => 'required|string|max:150',
            'refle_fovea_od'    => 'required|string|max:150',
            'papila_od'         => 'required|string|max:150',
            'excav_fisio_od'    => 'required|string|max:150',
            'profundidad_od'    => 'required|string|max:150',
            'vasos_od'          => 'required|string|max:150',
            'rela_arte_od'      => 'required|string|max:150',
            'macula_od'         => 'required|string|max:150',
            'reti_perif_od'     => 'required|string|max:150',
            'medi_refrin_os'    => 'required|string|max:150',
            'refle_fovea_os'    => 'required|string|max:150',
            'papila_os'         => 'required|string|max:150',
            'excav_fisio_os'    => 'required|string|max:150',
            'profundidad_os'    => 'required|string|max:150',
            'vasos_os'          => 'required|string|max:150',
            'rela_arte_os'      => 'required|string|max:150',
            'macula_os'         => 'required|string|max:150',
            'reti_perif_os'     => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos oftalmoscopia edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'medi_refrin_od'    => $datosvalidados['medi_refrin_od'] ?? $oftalmoscopia->medi_refrin_od,
            'refle_fovea_od'    => $datosvalidados['refle_fovea_od'] ?? $oftalmoscopia->refle_fovea_od,
            'papila_od'         => $datosvalidados['papila_od'] ?? $oftalmoscopia->papila_od,
            'excav_fisio_od'    => $datosvalidados['excav_fisio_od'] ?? $oftalmoscopia->excav_fisio_od,
            'profundidad_od'    => $datosvalidados['profundidad_od'] ?? $oftalmoscopia->profundidad_od,
            'vasos_od'          => $datosvalidados['vasos_od'] ?? $oftalmoscopia->vasos_od,
            'rela_arte_od'      => $datosvalidados['rela_arte_od'] ?? $oftalmoscopia->rela_arte_od,
            'macula_od'         => $datosvalidados['macula_od'] ?? $oftalmoscopia->macula_od,
            'reti_perif_od'     => $datosvalidados['reti_perif_od'] ?? $oftalmoscopia->reti_perif_od,
            'medi_refrin_os'    => $datosvalidados['medi_refrin_os'] ?? $oftalmoscopia->medi_refrin_os,
            'refle_fovea_os'    => $datosvalidados['refle_fovea_os'] ?? $oftalmoscopia->refle_fovea_os,
            'papila_os'         => $datosvalidados['papila_os'] ?? $oftalmoscopia->papila_os,
            'excav_fisio_os'    => $datosvalidados['excav_fisio_os'] ?? $oftalmoscopia->excav_fisio_os,
            'profundidad_os'    => $datosvalidados['profundidad_os'] ?? $oftalmoscopia->profundidad_os,
            'vasos_os'          => $datosvalidados['vasos_os'] ?? $oftalmoscopia->vasos_os,
            'rela_arte_os'      => $datosvalidados['rela_arte_os'] ?? $oftalmoscopia->rela_arte_os,
            'macula_os'         => $datosvalidados['macula_os'] ?? $oftalmoscopia->macula_os,
            'reti_perif_os'     => $datosvalidados['reti_perif_os'] ?? $oftalmoscopia->reti_perif_os,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $oftalmoscopia->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $oftalmoscopia->save();

        // si la Oftalmoscopia fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Oftalmoscopia fue actualizado',
            'oftalmoscopia' => $oftalmoscopia,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // Funcion para buscar todas las Oftalmoscopias x historia clinica
    public function traeroftalmoscopiashistoriaclinica($id){
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
        $todasoftalmoscopiasxhistoria = Oftalmoscopia::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if ($todasoftalmoscopiasxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todasoftalmoscopiasxhistoria, 200);
    }


    // funcion para traer los registros de Oftalmoscopia mas recientes deacuerdo al id de la historia clinica
    public function traeroftalmoscopiamasreciente($id){
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
        $registroreciente = Oftalmoscopia::where('id_historia', $id)
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
