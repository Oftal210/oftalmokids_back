<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Importamos el modelo de Preconsulta con la siguiente direccion
use App\Models\Preconsulta;

use App\Models\Hijo;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\FalseType;

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
            'hijo'          => 'required',
            'uso_gafas'     => 'required|boolean',
            'motivo_gafas'  => 'nullable|string',
            'uso_medic'     => 'required|boolean',
            'motivo_medic'  => 'nullable|string',
            'limite_panta'  => 'required|boolean',
            'motivo_panta'  => 'nullable|string',
            'activ_libre'   => 'required|boolean',
            'motivo_activ'  => 'nullable|string',
            'buen_alimen'   => 'required|boolean',
            'motivo_buen'   => 'nullable|string',
            'solict_contr'  => 'required|boolean',
            'motivo_contr'  => 'nullable|string',
            'punt_precon'   => 'required|digits:1'
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
            'uso_gafa_lentes'       => $request->uso_gafas,
            'motivo_uso_gafas'      => $request->motivo_gafas,
            'uso_medicamento'       => $request->uso_medic,
            'motivo_uso_medicam'    => $request->motivo_medic,
            'limit_pantalla'        => $request->limite_panta,
            'motiv_limit_pantalla'  => $request->motivo_panta,
            'activid_air_libre'     => $request->activ_libre,
            'motiv_acti_libre'      => $request->motivo_activ,
            'buena_aliment'         => $request->buen_alimen,
            'motiv_bue_alimen'      => $request->motivo_buen,
            'solicitar_control'     => $request->solict_contr,
            'motiv_soli_control'    => $request->motivo_contr,
            'puntua_preconsulta'    => $request->punt_precon
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
            'uso_gafas'     => 'sometimes|boolean',
            'motivo_gafas'  => 'sometimes|string',
            'uso_medic'     => 'sometimes|boolean',
            'motivo_medic'  => 'sometimes|string',
            'limite_panta'  => 'sometimes|boolean',
            'motivo_panta'  => 'sometimes|string',
            'activ_libre'   => 'sometimes|boolean',
            'motivo_activ'  => 'sometimes|string',
            'buen_alimen'   => 'sometimes|boolean',
            'motivo_buen'   => 'sometimes|string',
            'solict_contr'  => 'sometimes|boolean',
            'motivo_contr'  => 'sometimes|string',
            'punt_precon'   => 'sometimes|digits:1'
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
            'uso_gafa_lentes'       => $datosvalidados['uso_gafas'] ?? $preconsulta->uso_gafa_lentes,
            'motivo_uso_gafas'      => $datosvalidados['motivo_gafas'] ?? $preconsulta->motivo_uso_gafas,
            'uso_medicamento'       => $datosvalidados['uso_medic'] ?? $preconsulta->uso_medicamento,
            'motivo_uso_medicam'    => $datosvalidados['motivo_medic'] ?? $preconsulta->motivo_uso_medicam,
            'limit_pantalla'        => $datosvalidados['limite_panta'] ?? $preconsulta->limit_pantalla,
            'motiv_limit_pantalla'  => $datosvalidados['motivo_panta'] ?? $preconsulta->motiv_limit_pantalla,
            'activid_air_libre'     => $datosvalidados['activ_libre'] ?? $preconsulta->activid_air_libre,
            'motiv_acti_libre'      => $datosvalidados['motivo_activ'] ?? $preconsulta->motiv_acti_libre,
            'buena_aliment'         => $datosvalidados['buen_alimen'] ?? $preconsulta->buena_aliment,
            'motiv_bue_alimen'      => $datosvalidados['motivo_buen'] ?? $preconsulta->motiv_bue_alimen,
            'solicitar_control'     => $datosvalidados['solict_contr'] ?? $preconsulta->solicitar_control,
            'motiv_soli_control'    => $datosvalidados['motivo_contr'] ?? $preconsulta->motiv_soli_control,
            'puntua_preconsulta'    => $datosvalidados['punt_precon'] ?? $preconsulta->puntua_preconsulta
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


    // Funcion para buscar todos los registros de un hijo especifico
    public function preconsdelhijo ($id){

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

        // Aquí $hijoprecon es una colección que contiene todos los registros encontrados
        $hijoprecon = Preconsulta::where('id_hijo', $id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$hijoprecon){
            $data = [
                'mensaje' => 'No se encontraron preconsultas del Hijo enviado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($hijoprecon, 200);
    }


    // Funcion para realizar un promedio del puntaje de sus preconsultas
    public function promediomespreconsulta($id){
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

        // Aquí $hijoprecon es una colección que contendra todos los registros encontrados
        $hijoprecon = Preconsulta::where('id_hijo', $id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$hijoprecon){
            $data = [
                'mensaje' => 'No se encontraron preconsultas del Hijo enviado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Aquí buscaremos el promedio de puntaje del mes en el que nos encontramos
        $promeprecon = Preconsulta::where('id_hijo', $id)                       // filtramos por el hijo que se necesita
                                  ->whereMonth('fecha_preconsulta', now()->month) // filtramos el mes actual
                                  ->whereyear('fecha_preconsulta', now()->year)   // filtramos el año actual
                                  ->avg('puntua_preconsulta');                    // realizamos promedio de los registros encontrados
                                  
        // Validamos si la variable con la data esta vacia y NO ENCONTRO ABSOLUTA NADA
        if (!$promeprecon){
            $data = [
                'mensaje' => 'No se encontraron preconsultas de este mes',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente, (int) es para quitar los decimales y dejar solo la parte entera, ej: 5,7 lo deja en 5
        return response()->json((int)$promeprecon, 200);
    }
}