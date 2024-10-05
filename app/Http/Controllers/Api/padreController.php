<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de padres con la siguiente direccion
use App\Models\Padre;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

// Importamos el paquete para realizar hash en la contraseña
use Illuminate\Support\Facades\Hash;

class padreController extends Controller
{
    // Funcion para llamar a todos los padres del sistema 
    public function index(){

        // de esta manera buscamos todos los padres del sistema y los pasamos a la variable siguiente
        $padres = Padre::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($padres->isEmpty()){
            return response()->json(['mensaje' => 'no hay padres registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $padres. El 200 inidica que todo salio bien
        return response()->json($padres, 200);
    }

    // Funcion para almacenar los padres dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'required|numeric|digits_between:8,10',
            //'rol' => 'required|digits:1',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:10',
            'password' => 'required'
            //'direccion' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos padre',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Padre validando que los datos que vamos a agregar existan
        $padre = Padre::create([
            'id_padre'    => $request->documento,
            //'cod_rol'       => $request->rol,
            'nom_padre'   => $request->nombre,
            'ape_padre'   => $request->apellido,
            'email_padre' => $request->email,
            'tele_padre'  => $request->telefono,
            //'dire_padre' => $request->direccion,
            'cont_padre'  => Hash::make( $request->password)
        ]);

        // aqui validamos si se puedo crear el Padre, en caso de que este vacia, no se deberia haber guardado
        if(!$padre) {
            $data = [
                'mensaje' => 'Error al crear el Padre',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el Padre que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'padre' => $padre,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Padre especifico
    public function show($id){
        
        // Aqui se busca el Padre por la primaria que le estamos mandando como variable $id
        $padre = Padre::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$padre){
            $data = [
                'mensaje' => 'No se encontro al Padre',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Padre fue encontrado lo colocara dentor de esta variable
        $data = [
            'padre' => $padre,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Padre
    public function destroy($id){

        // Aqui se busca el Padre por la primaria que le estamos mandando como variable $id
        $padre = Padre::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$padre){
            $data = [
                'mensaje' => 'No se encontro al Padre para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Padre encontrado 
        $padre->delete();

        // si el Padre fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Padre fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Padre
    public function update( Request $request, $id) {

        // Aqui se busca el Padre por la primaria que le estamos mandando como variable $id
        $padre = Padre::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$padre){
            $data = [
                'mensaje' => 'No se encontro al Padre para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'sometimes|numeric|digits_between:8,10',
            //'rol' => 'sometimes|digits:1',
            'nombre' => 'sometimes',
            'apellido' => 'sometimes',
            'email' => 'sometimes|email',
            'telefono' => 'sometimes|digits:10',
            'password' => 'sometimes'
            //'direccion' => 'sometimes'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos padre edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'id_padre' => $datosvalidados['documento'] ?? $padre->id_padre,
            //'cod_rol' => $datosvalidados['rol'] ?? $padre->cod_rol,
            'nom_padre' => $datosvalidados['nombre'] ?? $padre->nom_padre,
            'ape_padre' => $datosvalidados['apellido'] ?? $padre->ape_padre,
            'email_padre' => $datosvalidados['email'] ?? $padre->email_padre,
            'tele_padre' => $datosvalidados['telefono'] ?? $padre->tele_padre,
            //'dire_padre' => $datosvalidados['direccion'] ?? $padre->dire_padre,
        ];

        // Si la password es parte de los campos enviados, se encriptara antes de agregarla al mapeo
        if (isset($datosvalidados['password'])) {
            $mappedData['cont_padre'] = bcrypt($datosvalidados['password']);
        }

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $padre->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $padre->save();

        // si el Padre fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Padre fue actualizado',
            'padre' => $padre,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
