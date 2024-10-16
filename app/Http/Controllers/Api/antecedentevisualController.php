<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Antecedente visual con la siguiente direccion
use App\Models\Antecedente_visual;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class antecedentevisualController extends Controller
{
    // Funcion para llamar a todos los Antecedente visual del sistema 
    public function index(){

        // de esta manera buscamos todos los Antecedente visual del sistema y los pasamos a la variable siguiente
        $antecevisual = Antecedente_visual::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($antecevisual->isEmpty()){
            return response()->json(['mensaje' => 'no hay Antecedente visual registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $antecevisual. El 200 inidica que todo salio bien
        return response()->json($antecevisual, 200);
    }

    // Funcion para almacenar los Antecedente visual dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'              => 'required',
            'correcion_optica'              => 'required|boolean',
            'edad_lente_primera_vez'        => 'required|digits_between:1,3',
            'cuantos_cambio_rx'             => 'required|digits_between:1,3',
            'motivo_cambio_rx'              => 'required|string',
            'material_tratamiento_optico'   => 'required|string',
            'indicaciones_uso'              => 'required|string',
            'fecha_ultimo_examen'           => 'required|date'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos antecende visual',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Antecedente visual validando que los datos que vamos a agregar existan
        $antecevisual = Antecedente_visual::create([
            'id_historia'           => $request->historia_clinica,
            'correcion_optica'      => $request->correcion_optica,
            'edad_lentes_prim_vez'  => $request->edad_lente_primera_vez,
            'cuantos_cambio_rx'     => $request->cuantos_cambio_rx,
            'motivo_cambio_rx'      => $request->motivo_cambio_rx,
            'material_tratam_optic' => $request->material_tratamiento_optico,
            'indicacion_uso'        => $request->indicaciones_uso,
            'fecha_ultimo_examen'   => $request->fecha_ultimo_examen
        ]);

        // aqui validamos si se puedo crear el Antecedente visual, en caso de que este vacia, no se deberia haber guardado
        if(!$antecevisual) {
            $data = [
                'mensaje' => 'Error al crear el Antecedente visual',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el antecevisual que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'antecedente_visual' => $antecevisual,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Antecedente visual especifico
    public function show($id){
        
        // Aqui se busca el Antecedente visual por la primaria que le estamos mandando como variable $id
        $antecevisual = Antecedente_visual::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$antecevisual){
            $data = [
                'mensaje' => 'No se encontro al Antecedente visual',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Antecedente visual fue encontrado lo colocara dentro de esta variable
        $data = [
            'antecedente_visual' => $antecevisual,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Antecevisual
    public function destroy($id){

        // Aqui se busca el Antecedente visual por la primaria que le estamos mandando como variable $id
        $antecevisual = Antecedente_visual::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$antecevisual){
            $data = [
                'mensaje' => 'No se encontro al Antecedente visual para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Antecedente visual encontrado 
        $antecevisual->delete();

        // si el Antecedente visual fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Antecedente visual fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Antecedente visual
    public function update( Request $request, $id) {

        // Aqui se busca el Antecedente visual por la primaria que le estamos mandando como variable $id
        $antecevisual = Antecedente_visual::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$antecevisual){
            $data = [
                'mensaje' => 'No se encontro al Antecedente visual para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'correcion_optica'              => 'sometimes|boolean',
            'edad_lente_primera_vez'        => 'sometimes|digits_between:1,3',
            'cuantos_cambio_rx'             => 'sometimes|digits_between:1,3',
            'motivo_cambio_rx'              => 'sometimes|string',
            'material_tratamiento_optico'   => 'sometimes|string',
            'indicaciones_uso'              => 'sometimes|string',
            'fecha_ultimo_examen'           => 'sometimes|date'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Antecedente visual edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'correcion_optica'      => $datosvalidados['correcion_optica'] ?? $antecevisual->correcion_optica,
            'edad_lentes_prim_vez'  => $datosvalidados['edad_lente_primera_vez'] ?? $antecevisual->edad_lentes_prim_vez,
            'cuantos_cambio_rx'     => $datosvalidados['cuantos_cambio_rx'] ?? $antecevisual->cuantos_cambio_rx,
            'motivo_cambio_rx'      => $datosvalidados['motivo_cambio_rx'] ?? $antecevisual->motivo_cambio_rx,
            'material_tratam_optic' => $datosvalidados['material_tratamiento_optico'] ?? $antecevisual->material_tratam_optic,
            'indicacion_uso'        => $datosvalidados['indicaciones_uso'] ?? $antecevisual->indicacion_uso,
            'fecha_ultimo_examen'   => $datosvalidados['fecha_ultimo_examen'] ?? $antecevisual->fecha_ultimo_examen
        ];

        
        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $antecevisual->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $antecevisual->save();

        // si el Antecedente visual fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Antecedente visual fue actualizado',
            'antecedente_visual' => $antecevisual,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
