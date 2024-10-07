<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Preconsulta con la siguiente direccion
use App\Models\Preconsulta;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class preconsultaController extends Controller
{
    // Funcion para llamar a todos las Preconsulta del sistema 
    public function index(){

        // de esta manera buscamos todos las Preconsulta del sistema y los pasamos a la variable siguiente
        $preconsulta = Preconsulta::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($preconsulta->isEmpty()){
            return response()->json(['mensaje' => 'no hay preconsultas registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $preconsulta. El 200 inidica que todo salio bien
        return response()->json($preconsulta, 200);
    }

    // Funcion para almacenar las Preconsulta dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'hijo' => 'required|numeric|digits_between:8,10',
            'uso_gafas' => 'required|boolean',
            'motivo_gafas' => 'nullable|string',
            'uso_medic' => 'required|boolean',
            'motivo_medic' => 'nullable|string',
            'limite_panta' => 'required|boolean',
            'motivo_panta' => 'nullable|string',
            'activ_libre'=> 'required|boolean',
            'motivo_activ'=> 'nullable|string',
            'buen_alimen'=> 'required|boolean',
            'motivo_buen'=> 'nullable|string',
            'solict_contr'=> 'required|boolean',
            'motivo_contr'=> 'nullable|string',
            'punt_precon'=> 'required|digits:1'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos preconsulta',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Preconsulta validando que los datos que vamos a agregar existan
        $preconsulta = Preconsulta::create([
            'id_hijo'               => $request->hijo,
            'uso_gaf_lente'         => $request->uso_gafas,
            'motiv_uso_gaf'         => $request->motivo_gafas,
            'uso_medicam'           => $request->uso_medic,
            'motiv_uso_medicam'     => $request->motivo_medic,
            'limit_pantalla'        => $request->limite_panta,
            'motiv_limit_pantalla'  => $request->motivo_panta,
            'activid_air_libre'     => $request->activ_libre,
            'motiv_acti_libre'      => $request->motivo_activ,
            'buena_aliment'         => $request->buen_alimen,
            'motiv_bue_alimen'      => $request->motivo_buen,
            'solicit_control'       => $request->solict_contr,
            'motiv_soli_control'    => $request->motivo_contr,
            'puntua_preconsul'      => $request->punt_precon
        ]);

        // aqui validamos si se puedo crear la Preconsulta, en caso de que este vacia, no se deberia haber guardado
        if(!$preconsulta) {
            $data = [
                'mensaje' => 'Error al crear la Preconsulta',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Preconsulta que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'preconsulta' => $preconsulta,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Preconsulta especifico
    public function show($id){
        
        // Aqui se busca la Preconsulta por la primaria que le estamos mandando como variable $id
        $preconsulta = Preconsulta::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$preconsulta){
            $data = [
                'mensaje' => 'No se encontro al Preconsulta',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la preconsulta fue encontrado lo colocara dentor de esta variable
        $data = [
            'preconsulta' => $preconsulta,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Funcion para elimizar una Preconsulta
    public function destroy($id){

        // Aqui se busca la Preconsulta por la primaria que le estamos mandando como variable $id
        $preconsulta = Preconsulta::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$preconsulta){
            $data = [
                'mensaje' => 'No se encontro al Preconsulta para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Preconsulta encontrado 
        $preconsulta->delete();

        // si la Preconsulta fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Preconsulta fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Funcion para actualizar una Preconsulta
    public function update( Request $request, $id) {

        // Aqui se busca la Preconsulta por la primaria que le estamos mandando como variable $id
        $preconsulta = Preconsulta::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$preconsulta){
            $data = [
                'mensaje' => 'No se encontro la Preconsulta para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'hijo' => 'sometimes|numeric|digits_between:8,10',
            'uso_gafas' => 'sometimes|boolean',
            'motivo_gafas' => 'sometimes',
            'uso_medic' => 'sometimes|boolean',
            'motivo_medic' => 'sometimes|email',
            'limite_panta' => 'sometimes|boolean',
            'motivo_panta' => 'sometimes',
            'activ_libre'=> 'sometimes|boolean',
            'motivo_activ'=> 'sometimes',
            'buen_alimen'=> 'sometimes|boolean',
            'motivo_buen'=> 'sometimes',
            'solict_contr'=> 'sometimes|boolean',
            'motivo_contr'=> 'sometimes',
            'punt_precon'=> 'sometimes|digits:1'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos preconsulta edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'id_hijo'   => $datosvalidados['hijo'] ?? $preconsulta->id_hijo,
            'uso_gaf_lente'       => $datosvalidados['uso_gafas'] ?? $preconsulta->uso_gaf_lente,
            'motiv_uso_gaf'   => $datosvalidados['motivo_gafas'] ?? $preconsulta->motiv_uso_gaf,
            'uso_medicam' => $datosvalidados['uso_medic'] ?? $preconsulta->uso_medicam,
            'motiv_uso_medicam'  => $datosvalidados['motivo_medic'] ?? $preconsulta->motiv_uso_medicam,
            'limit_pantalla'  => $datosvalidados['limite_panta'] ?? $preconsulta->limit_pantalla,
            'motiv_limit_pantalla'  => $datosvalidados['motivo_panta'] ?? $preconsulta->motiv_limit_pantalla,
            'activid_air_libre'  => $datosvalidados['activ_libre'] ?? $preconsulta->activid_air_libre,
            'motiv_acti_libre'  => $datosvalidados['motivo_activ'] ?? $preconsulta->motiv_acti_libre,
            'buena_aliment'  => $datosvalidados['buen_alimen'] ?? $preconsulta->buena_aliment,
            'motiv_bue_alimen'  => $datosvalidados['motivo_buen'] ?? $preconsulta->motiv_bue_alimen,
            'solicit_control'  => $datosvalidados['solict_contr'] ?? $preconsulta->solicit_control,
            'motiv_soli_control'  => $datosvalidados['motivo_contr'] ?? $preconsulta->motiv_soli_control,
            'puntua_preconsul'  => $datosvalidados['punt_precon'] ?? $preconsulta->puntua_preconsul,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $preconsulta->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $preconsulta->save();

        // si la Preconsulta fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Preconsulta fue actualizado',
            'preconsulta' => $preconsulta,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}