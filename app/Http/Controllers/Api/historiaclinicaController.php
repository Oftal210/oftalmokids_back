<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Historia Clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el modelo del Hijo con la siguiente direccion
use App\Models\Hijo;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class historiaclinicaController extends Controller
{
    // Funcion para llamar a todos las Historias Clinicas del sistema 
    public function index(){

        // de esta manera buscamos todos las Historias Clinicas del sistema y los pasamos a la variable siguiente
        $historiaclinica = Historia_clinica::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($historiaclinica->isEmpty()){
            return response()->json(['mensaje' => 'no hay Historias Clinicas registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $historiaclinica. El 200 inidica que todo salio bien
        return response()->json($historiaclinica, 200);
    }

    // Funcion para almacenar las Historias Clinicas dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            // Datos iniciales
            'hijo' =>  'required',
            'padre' => 'required',

            // Antecedes medico-personal
            'edad_embarazo_madre'       => 'required|digits_between:1,3',
            'fue_alto_riesgo'           => 'required|boolean',
            'especifique_riesgo'        => 'nullable|string',
            'semanas_gestacion'         => 'required|digits_between:1,2',
            'tipo_parto'                => 'required|string|max:50',
            'complicaciones_parto'      => 'required|boolean',
            'especifique_complicaciones'    => 'nullable|string',
            'uso_incubadora'            => 'required|boolean',
            'tiempo_incubadora'         => 'nullable|string', 
            'puntaje_apgar'             => 'required|digits_between:1,2',
            'respiro_lloro_alnacer'     => 'required|boolean',
            'emfermedad_en_embarazo'    => 'required|boolean',
            'especifque_enfermedad_emb' => 'nullable|string',
            'medicamente_en_embarazo'   => 'required|boolean',
            'especifique_medicamento'   => 'nullable|string',
            'emfermedad_sistemica'      => 'required|boolean',
            'especifique_enfer_sistemica'   => 'nullable|string',
            'alergia'                   => 'required|boolean',
            'especifique_alergia'       => 'nullable|string',
            'cirugia_general_ocular'    => 'required|boolean'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos historia clinica',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Historia Clinica validando que los datos que vamos a agregar existan
        $historiaclinica = Historia_clinica::create([
            'id_hijo'                   => $request->hijo,
            'id_usuario'                => $request->padre,
            'edad_embarazo'             => $request->edad_embarazo_madre,
            'alto_riesgo'               => $request->fue_alto_riesgo,
            'especificar_riesgo'        => $request->especifique_riesgo,
            'semanas_gestacion'         => $request->semanas_gestacion,
            'tipo_parto'                => $request->tipo_parto,
            'complicacion'              => $request->complicaciones_parto,
            'especificar_compli'        => $request->especifique_complicaciones,     
            'uso_incubadora'            => $request->uso_incubadora,
            'tiempo_incubadora'         => $request->tiempo_incubadora,  
            'apgar_incubadora'          => $request->puntaje_apgar,
            'respiro_lloro_nacer'       => $request->respiro_lloro_alnacer,
            'enfermedades_embarazo'     => $request->emfermedad_en_embarazo,
            'especificar_enfermedades'  => $request->especifque_enfermedad_emb,   
            'medicamento_embarazo'      => $request->medicamente_en_embarazo,
            'especificar_medicamento'   => $request->especifique_medicamento,           
            'enfermedad_sistemica'      => $request->emfermedad_sistemica,
            'especif_enferm_sistemica'  => $request->especifique_enfer_sistemica,
            'alergia'                   => $request->alergia,
            'especificar_alergia'       => $request->especifique_alergia,
            'cirugia_ocular'            => $request->cirugia_general_ocular,
        ]);

        // aqui validamos si se puedo crear la Historia Clinica, en caso de que este vacia, no se deberia haber guardado
        if(!$historiaclinica) {
            $data = [
                'mensaje' => 'Error al crear la Historia clinica',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Historia Clinica que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'historia_clinica' => $historiaclinica,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Historia Clinica especifica
    public function show($id){
        
        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Historia Clinica fue encontrado lo colocara dentro de esta variable
        $data = [
            'historia_clinica' => $historiaclinica,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Historia Clinica
    public function destroy($id){

        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Historia Clinica encontrada
        $historiaclinica->delete();

        // si la Historia Clinica fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Historia Clinica fue eliminada',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Historia Clinica
    public function update( Request $request, $id) {

        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            // Antecedes medico-personal
            'edad_embarazo_madre'       => 'sometimes|digits_between:1,3',
            'fue_alto_riesgo'           => 'sometimes|boolean',
            'especifique_riesgo'        => 'sometimes|string',
            'semanas_gestacion'         => 'sometimes|digits_between:1,2',
            'tipo_parto'                => 'sometimes|string|max:50',
            'complicaciones_parto'      => 'sometimes|boolean',
            'especifique_complicaciones'    => 'sometimes|string',
            'uso_incubadora'            => 'sometimes|boolean',
            'tiempo_incubadora'         => 'sometimes|string', 
            'puntaje_apgar'             => 'sometimes|digits_between:1,2',
            'respiro_lloro_alnacer'     => 'sometimes|boolean',
            'emfermedad_en_embarazo'    => 'sometimes|boolean',
            'especifque_enfermedad_emb' => 'sometimes|string',
            'medicamente_en_embarazo'   => 'sometimes|boolean',
            'especifique_medicamento'   => 'sometimes|string',
            'emfermedad_sistemica'      => 'sometimes|boolean',
            'especifique_enfer_sistemica'   => 'sometimes|string',
            'alergia'                   => 'sometimes|boolean',
            'especifique_alergia'       => 'sometimes|string',
            'cirugia_general_ocular'    => 'sometimes|string'    
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Historia Clinica edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'edad_embarazo'             => $datosvalidados['edad_embarazo_madre'] ?? $historiaclinica->edad_embarazo,
            'alto_riesgo'               => $datosvalidados['fue_alto_riesgo'] ?? $historiaclinica->alto_riesgo,
            'especificar_riesgo'        => $datosvalidados['especifique_riesgo'] ?? $historiaclinica->especificar_riesgo,
            'semanas_gestacion'         => $datosvalidados['semanas_gestacion'] ?? $historiaclinica->semanas_gestacion,
            'tipo_parto'                => $datosvalidados['tipo_parto'] ?? $historiaclinica->tipo_parto,
            'complicacion '             => $datosvalidados['complicaciones_parto'] ?? $historiaclinica->complicacion,
            'especificar_compli '       => $datosvalidados['especifique_complicaciones'] ?? $historiaclinica->especificar_compli,
            'uso_incubadora '           => $datosvalidados['uso_incubadora'] ?? $historiaclinica->uso_incubadora,
            'tiempo_incubadora '        => $datosvalidados['tiempo_incubadora'] ?? $historiaclinica->tiempo_incubadora,
            'apgar_incubadora '         => $datosvalidados['puntaje_apgar'] ?? $historiaclinica->apgar_incubadora,
            'respiro_lloro_nacer '      => $datosvalidados['respiro_lloro_alnacer'] ?? $historiaclinica->respiro_lloro_nacer,
            'enfermedades_embarazo '    => $datosvalidados['emfermedad_en_embarazo'] ?? $historiaclinica->enfermedades_embarazo,
            'especificar_enfermedades ' => $datosvalidados['especifque_enfermedad_emb'] ?? $historiaclinica->especificar_enfermedades,
            'medicamento_embarazo '     => $datosvalidados['medicamente_en_embarazo'] ?? $historiaclinica->medicamento_embarazo,
            'especificar_medicamento '  => $datosvalidados['especifique_medicamento'] ?? $historiaclinica->especificar_medicamento,
            'enfermedad_sistemica '     => $datosvalidados['emfermedad_sistemica'] ?? $historiaclinica->enfermedad_sistemica,
            'especif_enferm_sistemica ' => $datosvalidados['especifique_enfer_sistemica'] ?? $historiaclinica->especif_enferm_sistemica,
            'alergia '                  => $datosvalidados['alergia'] ?? $historiaclinica->alergia,
            'especificar_alergia '      => $datosvalidados['especifique_alergia'] ?? $historiaclinica->especificar_alergia,
            'cirugia_ocular '           => $datosvalidados['cirugia_general_ocular'] ?? $historiaclinica->cirugia_ocular
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $historiaclinica->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $historiaclinica->save();

        // si la Historia Clinica fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Historia Clinica fue actualizada',
            'historia_clinica' => $historiaclinica,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // funcion para traer la historia clinica de un hijo en especifico
    public function historiasdelhijo ($id){

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al hijo',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Aquí $hijohistorias es una colección que contiene todos los registros encontrados
        $hijohistorias = Historia_clinica::where('id_hijo', $id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$hijohistorias){
            $data = [
                'mensaje' => 'No se encontraron historias clinicas del Hijo enviado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($hijohistorias, 200);
    }
}
