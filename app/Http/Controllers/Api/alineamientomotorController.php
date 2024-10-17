<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de alineamiento motor con la siguiente direccion
use App\Models\Alineamiento_motor;

// Importamos el modelo de alineamiento motor con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class alineamientomotorController extends Controller
{
    // Funcion para llamar a todos los Alineamiento motor del sistema 
    public function index(){

        // de esta manera buscamos todos los Alineamiento motor del sistema y los pasamos a la variable siguiente
        $alineamimotor = Alineamiento_motor::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($alineamimotor->isEmpty()){
            return response()->json(['mensaje' => 'no hay Alineamiento motor registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $alineamimotor. El 200 inidica que todo salio bien
        return response()->json($alineamimotor, 200);
    }

    // Funcion para almacenar los Alineamiento motor dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'  =>'required',
            'hirschberg'        =>'required|string|max:150',
            'bruckner'          =>'required|string|max:150', 
            'covet_test_vl'     =>'required|string|max:150',
            'covet_test_vp'     =>'required|string|max:150',
            'esta_acomo_flex'   =>'required|string|max:150',
            'esta_acomo_aa'     =>'required|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos alineamiento motor',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Alineamienot Motor validando que los datos que vamos a agregar existan
        $alineamimotor = Alineamiento_motor::create([
            'id_historia'       =>$request->historia_clinica,
            'test_hirschberg'   =>$request->hirschberg,
            'test_bruckner'     =>$request->bruckner,
            'covet_test_vl'     =>$request->covet_test_vl,
            'covet_test_vp'     =>$request->covet_test_vp,
            'esta_acomo_flex'   =>$request->esta_acomo_flex,
            'esta_acomo_aa'     =>$request->esta_acomo_aa
        ]);

        // aqui validamos si se puedo crear el Alineamiento motor, en caso de que este vacia, no se deberia haber guardado
        if(!$alineamimotor) {
            $data = [
                'mensaje' => 'Error al crear el Alineamiento motor',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el Alineamiento motor que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'alineamiento_motor' => $alineamimotor,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Alineamiento motor especifico
    public function show($id){
        
        // Aqui se busca el Alineamiento motor por la primaria que le estamos mandando como variable $id
        $alineamimotor = Alineamiento_motor::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$alineamimotor){
            $data = [
                'mensaje' => 'No se encontro al Alineamiento motor',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Alineamiento motor fue encontrado lo colocara dentro de esta variable
        $data = [
            'alineamiento_motor' => $alineamimotor,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Alineamiento motor
    public function destroy($id){

        // Aqui se busca el Alineamiento motor por la primaria que le estamos mandando como variable $id
        $alineamimotor = Alineamiento_motor::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$alineamimotor){
            $data = [
                'mensaje' => 'No se encontro al Alineamiento motor para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Alineamiento motor encontrado 
        $alineamimotor->delete();

        // si el Alineamiento motor fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Alineamiento motor fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Alineamiento motor
    public function update( Request $request, $id) {

        // Aqui se busca el Alineamiento motor por la primaria que le estamos mandando como variable $id
        $alineamimotor = Alineamiento_motor::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$alineamimotor){
            $data = [
                'mensaje' => 'No se encontro al Alineamiento motor para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'hirschberg' =>'sometimes|string|max:150',
            'bruckner' =>'sometimes|string|max:150', 
            'covet_test_vl' =>'sometimes|string|max:150',
            'covet_test_vp' =>'sometimes|string|max:150',
            'esta_acomo_flex' =>'sometimes|string|max:150',
            'esta_acomo_aa' =>'sometimes|string|max:150'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Alineamiento motor edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'test_hirschberg' => $datosvalidados['hirschberg'] ?? $alineamimotor->test_hirschberg,
            'test_bruckner'   => $datosvalidados['bruckner'] ?? $alineamimotor->test_bruckner,
            'covet_test_vl'   => $datosvalidados['covet_test_vl'] ?? $alineamimotor->covet_test_vl,
            'covet_test_vp' => $datosvalidados['covet_test_vp'] ?? $alineamimotor->covet_test_vp,
            'esta_acomo_flex'  => $datosvalidados['esta_acomo_flex'] ?? $alineamimotor->esta_acomo_flex,
            'esta_acomo_aa'  => $datosvalidados['esta_acomo_aa'] ?? $alineamimotor->esta_acomo_aa,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $alineamimotor->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $alineamimotor->save();

        // si el Alineamiento motor fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Alineamiento motor fue actualizado',
            'alineamiento_motor' => $alineamimotor,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Funcion para buscar todos los Alineamientos motor x historia clinica
    public function traeralineamientoshistoriaclinica($id){
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
        $todosalineamientosxhistoria = Alineamiento_motor::where('id_historia', $id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$todosalineamientosxhistoria){
            $data = [
                'mensaje' => 'no hay registros',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todosalineamientosxhistoria, 200);
    }


    // funcion para traer los registros de alineamiento motor mas recientes deacuerdo al id de la historia clinica
    public function traeralineamientosmasreciente($id){
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
        $registroreciente = Alineamiento_motor::where('id_historia', $id)
                                              ->latest('created_at')->first();

        // Validamos si la variable con la data esta vacia
        if (!$registroreciente){
            $data = [
                'mensaje' => 'no hay registros',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($registroreciente, 200);
    }


}
