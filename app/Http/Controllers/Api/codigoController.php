<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de codigo con la siguiente direccion
use App\Models\Codigo;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class codigoController extends Controller
{
    // Funcion para llamar a todos los Cogidos del sistema
    public function index(){

        // de esta manera buscamos todos los codigos del sistema y los pasamos a la variable siguiente
        $codigo = Codigo::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($codigo->isEmpty()){
            return response()->json(['mensaje' => 'no hay codigos registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $codigo. El 200 inidica que todo salio bien
        return response()->json($codigo, 200);
    }

    // Funcion para alamacenar los Codigos dentro de la base de datos
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos codigo',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Codigo validando que los datos que vamos a agregar existan
        $codigo = Codigo::create([
            'nom_codigo'       => $request->nombre,
            'descrip_codigo'   => $request->descripcion
        ]);

        // aqui validamos si se puedo crear el Codigo, en caso de que este vacia, no se deberia haber guardado
        if(!$codigo) {
            $data = [
                'mensaje' => 'Error al crear el Usuario',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el codigo que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'codigo' => $codigo,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un codigo especifico
    public function show($id){
        
        // Aqui se busca el Codigo por la primaria que le estamos mandando como variable $id
        $codigo = Codigo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$codigo){
            $data = [
                'mensaje' => 'No se encontro el Codigo',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Codigo fue encontrado lo colocara dentor de esta variable
        $data = [
            'codigo' => $codigo,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Codigo
    public function destroy($id){

        // Aqui se busca el Codigo por la primaria que le estamos mandando como variable $id
        $codigo = Codigo::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$codigo){
            $data = [
                'mensaje' => 'No se encontro el Codigo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Codigo encontrado 
        $codigo->delete();

        // si el Codigo fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Codigo fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Codigo
    public function update( Request $request, $id) {

        // Aqui se busca el Codigo por la primaria que le estamos mandando como variable $id
        $codigo = Codigo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$codigo){
            $data = [
                'mensaje' => 'No se encontro el Codigo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes',
            'descripcion' => 'sometimes'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos codigo edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'nom_codigo' => $datosvalidados['nombre'] ?? $codigo->nom_codigo,
            'descrip_codigo' => $datosvalidados['descripcion'] ?? $codigo->descrip_codigo
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $codigo->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $codigo->save();

        // si el Codigo fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Codigo fue actualizado',
            'usuario' => $codigo,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
