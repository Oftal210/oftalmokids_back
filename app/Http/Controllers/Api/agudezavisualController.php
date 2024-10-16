<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de agudeza visual con la siguiente direccion
use App\Models\Agudeza_visual;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class agudezavisualController extends Controller
{
    // Funcion para llamar a todas las Agudeza visual del sistema 
    public function index(){

        // de esta manera buscamos todos las Agudeza visual del sistema y los pasamos a la variable siguiente
        $agudezavisual = Agudeza_visual::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($agudezavisual->isEmpty()){
            return response()->json(['mensaje' => 'no hay Agudeza visual registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $agudezavisual. El 200 inidica que todo salio bien
        return response()->json($agudezavisual, 200);
    }

    // Funcion para almacenar las Agudeza visual dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica' => 'required',
            'test'          => 'required|string|max:150',
            'distancia'     => 'required|string|max:150',
            'od_sc_vl'      => 'required|string|max:150',
            'od_vp'         => 'required|string|max:150',
            'od_ph'         => 'required|string|max:150',
            'os_sc_vl'      => 'required|string|max:150',
            'os_vp'         => 'required|string|max:150',
            'os_ph'         => 'required|string|max:150',
            'lensome_od'    => 'required|string|max:150',
            'lensome_os'    => 'required|string|max:150',
            'od_cc_vl'      => 'required|string|max:150',
            'od_vp_lenso'   => 'required|string|max:150',
            'os_cc_vl'      => 'required|string|max:150',
            'os_vp_lenso'   => 'required|string|max:150',
            'queratome_od'  => 'required|string|max:150',
            'queratome_os'  => 'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos agudeza visual insert',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Agudeza visual validando que los datos que vamos a agregar existan
        $agudezavisual = Agudeza_visual::create([
            'id_historia' => $request->historia_clinica,
            'agude_visu_test' => $request->test,
            'agude_visu_distan' => $request->distancia,
            'od_sc_vl' => $request->od_sc_vl,
            'od_vp' => $request->od_vp,
            'od_ph' => $request->od_ph,
            'os_sc_vl' => $request->os_sc_vl,
            'os_vp' => $request->os_vp,
            'os_ph' => $request->os_ph,
            'lensome_od' => $request->lensome_od,
            'lensome_os' => $request->lensome_os,
            'od_cc_vl' => $request->od_cc_vl,
            'od_vp_lenso' => $request->od_vp_lenso,
            'os_cc_vl' => $request->os_cc_vl,
            'os_vp_lenso' => $request->os_vp_lenso,
            'queratome_od' => $request->queratome_od,
            'queratome_os' => $request->queratome_os
        ]);

        // aqui validamos si se puedo crear la Agudeza visual, en caso de que este vacia, no se deberia haber guardado
        if(!$agudezavisual) {
            $data = [
                'mensaje' => 'Error al crear la Agudeza visual',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Agudeza visual que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'agudezavisual' => $agudezavisual,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Agudeza visual especifico
    public function show($id){
        
        // Aqui se busca la Agudeza visual por la primaria que le estamos mandando como variable $id
        $agudezavisual = Agudeza_visual::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$agudezavisual){
            $data = [
                'mensaje' => 'No se encontro al Agudeza visual',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Agudeza visual fue encontrado lo colocara dentro de esta variable
        $data = [
            'agudeza_visual' => $agudezavisual,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Agudeza visual
    public function destroy($id){

        // Aqui se busca la Agudeza visual por la primaria que le estamos mandando como variable $id
        $agudezavisual = Agudeza_visual::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$agudezavisual){
            $data = [
                'mensaje' => 'No se encontro al Agudeza visual para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Agudeza visual encontrado 
        $agudezavisual->delete();

        // si la Agudeza visual fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Agudeza visual fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Agudeza visual
    public function update( Request $request, $id) {

        // Aqui se busca la Agudeza visual por la primaria que le estamos mandando como variable $id
        $agudezavisual = Agudeza_visual::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$agudezavisual){
            $data = [
                'mensaje' => 'No se encontro al Agudeza visual para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'test' => 'sometimes|string',
            'distancia' => 'sometimes|string',
            'od_sc_vl'=> 'sometimes|string',
            'od_vp' => 'sometimes|string',
            'od_ph' => 'sometimes|string',
            'os_sc_vl' => 'sometimes|string',
            'os_vp' => 'sometimes|string',
            'os_ph' => 'sometimes|string',
            'lensome_od' => 'sometimes|string',
            'lensome_os' => 'sometimes|string',
            'od_cc_vl' => 'sometimes|string',
            'od_vp_lenso' => 'sometimes|string',
            'os_cc_vl' => 'sometimes|string',
            'os_vp_lenso' => 'sometimes|string',
            'queratome_od' => 'sometimes|string',
            'queratome_os' => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Agudeza visual edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'agude_visu_test'   => $datosvalidados['test'] ?? $agudezavisual->agude_visu_test,
            'agude_visu_distan' => $datosvalidados['distancia'] ?? $agudezavisual->agude_visu_distan,
            'od_sc_vl'          => $datosvalidados['od_sc_vl'] ?? $agudezavisual->od_sc_vl,
            'od_vp'             => $datosvalidados['od_vp'] ?? $agudezavisual->od_vp,
            'od_ph'             => $datosvalidados['od_ph'] ?? $agudezavisual->od_ph,
            'os_sc_vl'          => $datosvalidados['os_sc_vl'] ?? $agudezavisual->os_sc_vl,
            'os_vp'             => $datosvalidados['os_vp'] ?? $agudezavisual->os_vp,
            'os_ph'             => $datosvalidados['os_ph'] ?? $agudezavisual->os_ph,
            'lensome_od'        => $datosvalidados['lensome_od'] ?? $agudezavisual->lensome_od,
            'lensome_os'        => $datosvalidados['lensome_os'] ?? $agudezavisual->lensome_os,
            'od_cc_vl'          => $datosvalidados['od_cc_vl'] ?? $agudezavisual->od_cc_vl,
            'od_vp_lenso'       => $datosvalidados['od_vp_lenso'] ?? $agudezavisual->od_vp_lenso,
            'os_cc_vl'          => $datosvalidados['os_cc_vl'] ?? $agudezavisual->os_cc_vl,
            'os_vp_lenso'       => $datosvalidados['os_vp_lenso'] ?? $agudezavisual->os_vp_lenso,
            'queratome_od'      => $datosvalidados['queratome_od'] ?? $agudezavisual->queratome_od,
            'queratome_os'      => $datosvalidados['queratome_os'] ?? $agudezavisual->queratome_os,
            
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $agudezavisual->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $agudezavisual->save();

        // si la Agudeza visual fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Agudezavisual fue actualizado',
            'agudezavisual' => $agudezavisual,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
