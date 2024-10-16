<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Diagnostico x historia clinica con la siguiente direccion
use App\Models\Diagnostico_historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class diagnosticohistoriaclinicaController extends Controller
{
    // Funcion para llamar a todos los Diagnostico x historia clinica del sistema 
    public function index(){

        // de esta manera buscamos todos los Diagnostico x historia clinica del sistema y los pasamos a la variable siguiente
        $diag_his_cli= Diagnostico_historia_clinica::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($diag_his_cli->isEmpty()){
            return response()->json(['mensaje' => 'no hay Diagnostico x historia clinica registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $diag_his_cli. El 200 inidica que todo salio bien
        return response()->json($diag_his_cli, 200);
    }

    // Funcion para almacenar los Diagnostico x historia clinica dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'          => 'required',
            'diagnostico'               => 'required',
            'motivo_consulta'           => 'required|string',
            'tratamiento_diagnostico'   => 'required|string',
            'pronostico_diagnostico'    => 'required|string',
            'control_diagnostico'       => 'required|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Diagnostico x historia clinica',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Diagnostico x historia clinica validando que los datos que vamos a agregar existan
        $diag_his_cli = Diagnostico_historia_clinica::create([
            'id_historia'       => $request->historia_clinica,
            'id_diagnostico'    => $request->diagnostico,
            'motivo_consulta'   => $request->motivo_consulta,
            'tratamiento'       => $request->tratamiento_diagnostico,
            'pronostico'        => $request->pronostico_diagnostico,
            'control'           => $request->control_diagnostico
        ]);

        // aqui validamos si se puedo crear el Diagnostico x historia clinica, en caso de que este vacia, no se deberia haber guardado
        if(!$diag_his_cli) {
            $data = [
                'mensaje' => 'Error al crear el Diagnostico x historia clinica',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el Diagnostico x historia clinica que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Diagnostico x historia clinica especifico
    public function show($id){
        
        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro el Diagnostico x historia clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Diagnostico x historia clinica fue encontrado lo colocara dentro de esta variable
        $data = [
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Diagnostico x historia clinica
    public function destroy($id){

        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro al Diagnostico x historia clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Diagnostico x historia clinica encontrado 
        $diag_his_cli->delete();

        // si el Diagnostico x historia clinica fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico x historia clinica fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Diagnostico x historia clinica
    public function update( Request $request, $id) {

        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro al Diagnostico x historia clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'motivo_consulta'           => 'sometimes|string',
            'tratamiento_diagnostico'   => 'sometimes|string',
            'pronostico_diagnostico'    => 'sometimes|string',
            'control_diagnostico'       => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Diagnostico x historia clinica edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'motivo_consulta'   => $datosvalidados['motivo_consulta'] ?? $diag_his_cli->motivo_consulta,
            'tratamiento'       => $datosvalidados['tratamiento_diagnostico'] ?? $diag_his_cli->tratamiento,
            'pronostico'        => $datosvalidados['pronostico_diagnostico'] ?? $diag_his_cli->pronostico,
            'control'           => $datosvalidados['control_diagnostico'] ?? $diag_his_cli->control
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $diag_his_cli->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $diag_his_cli->save();

        // si el Diagnostico x historia clinica fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico x historia clinica fue actualizado',
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
