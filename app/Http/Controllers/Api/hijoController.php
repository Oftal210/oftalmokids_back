<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de hijos con la siguiente direccion
use App\Models\Hijo;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class hijoController extends Controller
{
    // Funcion para llamar a todos los hijos del sistema 
    public function index(){

        // de esta manera buscamos todos los hijos del sistema y los pasamos a la variable siguiente
        $hijos = Hijo::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($hijos->isEmpty()){
            return response()->json(['mensaje' => 'no hay hijos registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $hijos. El 200 inidica que todo salio bien
        return response()->json($hijos, 200);
    }

    // Funcion para almacenar los hijos dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento'     => 'required',
            'padre'         => 'required',
            'nombre'        => 'required|string|max:70',
            'apellido'      => 'required|string|max:70',
            'tipodoc'       => 'required|string|max:50',
            'nacimiento'    => 'required|date',
            'foto'          => 'required|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos hijo',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 200);
        }

        // aqui intentamos crear un Hijo validando que los datos que vamos a agregar existan
        $hijo = Hijo::create([
            'documento'         => $request->documento,
            'id_usuario'        => $request->padre,
            'nombre'            => $request->nombre,
            'apellido'          => $request->apellido,
            'tipo_documento'    => $request->tipodoc,
            'fecha_nacimiento'  => $request->nacimiento,
            'foto'              => $request->foto
        ]);

        // aqui validamos si se puedo crear el Hijo, en caso de que este vacia, no se deberia haber guardado
        if(!$hijo) {
            $data = [
                'mensaje' => 'Error al crear el Hijo',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 200);
        }

        // aqui colocamos en la variable $data el Hijo que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'hijo' => $hijo,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 200);
    }

    // Funcion para buscar un Hijo especifico
    public function show($id){
        
        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::where('documento', $id)->first();

        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al Hijo',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // si el Hijo fue encontrado lo colocara dentor de esta variable
        $data = [
            'hijo' => $hijo,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Hijo
    public function destroy($id){

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al Hijo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // Procedemos a eliminar al Hijo encontrado 
        $hijo->delete();

        // si el Hijo fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Hijo fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Hijo
    public function update( Request $request, $id) {

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al Hijo para eliminar',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre'        => 'sometimes|string|max:70',
            'apellido'      => 'sometimes|string|max:70',
            'tipodoc'       => 'sometimes|string|max:50',
            'nacimiento'    => 'sometimes|date',
            'foto'          => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos hijo edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 200);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'nombre'            => $datosvalidados['nombre'] ?? $hijo->nombre,
            'apellido'          => $datosvalidados['apellido'] ?? $hijo->apellido,
            'tipo_documento'    => $datosvalidados['tipodoc'] ?? $hijo->tipo_documento,
            'fecha_nacimiento'  => $datosvalidados['nacimiento'] ?? $hijo->fecha_nacimiento,
            'foto'              => $datosvalidados['foto'] ?? $hijo->foto,
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $hijo->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $hijo->save();

        // si el Hijo fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Hijo fue actualizado',
            'hijo' => $hijo,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // funcion para traer el numero de hijos que tenemos en el sistema
    public function traerCantidadHijos(){

        // de esta manera buscamos todos los hijos del sistema y los pasamos a la variable siguiente
        $cantidadHijos = Hijo::count();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($cantidadHijos == 0){
            return response()->json(['mensaje' => 'no hay hijos registrados en la tabla'], 200);
        }

        // este return devuelve todo lo que contiene la variable de $hijos. El 200 inidica que todo salio bien
        return response()->json($cantidadHijos, 200); // retornamos el numero de registros que se encontraron
    }
}
