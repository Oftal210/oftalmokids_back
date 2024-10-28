<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de usuarios con la siguiente direccion
use App\Models\User;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

// Importamos el paquete para realizar hash en la contraseña
use Illuminate\Support\Facades\Hash;

class usuarioController extends Controller
{
    // Funcion para llamar a todos los Usuarios del sistema 
    public function index(){

        // de esta manera buscamos todos los usuarios del sistema y los pasamos a la variable siguiente
        $usuarios = User::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($usuarios->isEmpty()){
            return response()->json(['mensaje' => 'no hay usuarios registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $usuarios. El 200 inidica que todo salio bien
        return response()->json($usuarios, 200);
    }

    // Funcion para almacenar los Usuarios dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'required|string',
            'rol'       => 'required|digits:1',
            'nombre'    => 'required|string|max:50',
            'apellido'  => 'required|string|max:50',
            'email'     => 'required|email|max:50',
            'telefono'  => 'required|string|max:13',
            'password'  => 'required|string|max:255'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos usuario',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Usuario validando que los datos que vamos a agregar existan
        $usuario = User::create([
            'documento'     => $request->documento,
            'id_rol'        => $request->rol,
            'nombre'        => $request->nombre,
            'apellido'      => $request->apellido,
            'email'         => $request->email,
            'telefono'      => $request->telefono,
            'contrasena'    => Hash::make( $request->password)
        ]);

        // aqui validamos si se puedo crear el Usuario, en caso de que este vacia, no se deberia haber guardado
        if(!$usuario) {
            $data = [
                'mensaje' => 'Error al crear el Usuario',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el usuario que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'usuario' => $usuario,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Usuario especifico
    public function show($id){
        
        // Aqui se busca el Usuario por la primaria que le estamos mandando como variable $id
        $usuario = User::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro al Usuario',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el usuario fue encontrado lo colocara dentro de esta variable
        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Usuario
    public function destroy($id){

        // Aqui se busca el Usuario por la primaria que le estamos mandando como variable $id
        $usuario = User::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro al Usuario para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Usuario encontrado 
        $usuario->delete();

        // si el usuario fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Usuario fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Usuario
    public function update( Request $request, $id) {

        // Aqui se busca el Usuario por la primaria que le estamos mandando como variable $id
        $usuario = User::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro al Usuario para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre'    => 'sometimes|string|max:50',
            'apellido'  => 'sometimes|string|max:50',
            'email'     => 'sometimes|email|max:50',
            'telefono'  => 'sometimes|string|max:13',
            'password'  => 'sometimes|string|max:255'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos usuario edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'nombre'        => $datosvalidados['nombre'] ?? $usuario->nombre,
            'apellido'      => $datosvalidados['apellido'] ?? $usuario->apellido,
            'email'         => $datosvalidados['email'] ?? $usuario->email,
            'telefono'      => $datosvalidados['telefono'] ?? $usuario->telefono,
            'contrasena'    => $datosvalidados['password'] ?? $usuario->contrasena,
        ];

        // Si la password es parte de los campos enviados, se encriptara antes de agregarla al mapeo
        if (isset($datosvalidados['password'])) {
            $mappedData['cont_usuario'] = bcrypt($datosvalidados['password']);
        }

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $usuario->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $usuario->save();

        // si el Usuario fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Usuario fue actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // funcion para buscar a todos los usuarios de rol 2 (padre)
    public function traerUsuariosPadre() {
        // de esta manera buscamos todos los usuarios padre y los pasamos a la variable siguiente
        $usuariosPadre = User::where('id_rol', 2)->count();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($usuariosPadre == 0){
            return response()->json(['mensaje' => 'no hay usuarios padre registrados']);
        }

        // este return devuelve todo lo que contiene la variable de $usuarios. El 200 inidica que todo salio bien
        //return response()->json($usuariosPadre, 200);
        return response()->json((int)$usuariosPadre, 200); // retornamos el numero de registros que se encontraron
    }
}
