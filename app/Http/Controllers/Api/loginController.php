<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de usuarios con la siguiente direccion
use App\Models\User;
// Importamos el paquete para encriptar la contraseña
use Illuminate\Support\Facades\Hash;

// Importamos el paquete para autenticar
use Illuminate\Support\Facades\Auth;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    //
    public function registrarse(Request $request){
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'required|numeric|digits_between:8,10',
            'rol' => 'required|digits:1',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:10',
            'password' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos reg',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Usuario validando que los datos que vamos a agregar existan
        $usuario = User::create([
            'id_usuario'    => $request->documento,
            'cod_rol'       => $request->rol,
            'nom_usuario'   => $request->nombre,
            'ape_usuario'   => $request->apellido,
            'email_usuario' => $request->email,
            'tele_usuario'  => $request->telefono,
            'cont_usuario'  => Hash::make( $request->password)
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

        // Generamos el token para el usuario
        $accessToken = $usuario->createToken('authToken')->accessToken; 

        // aqui colocamos en la variable $data el usuario que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'usuario' => $usuario,
            'access_token' => $accessToken
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }
    

    // funcion para realizar el inicio de sesion de los usuarios
    public function login(Request $request) {

        // Verificamos los datos que nos estan enviando
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|numeric|digits_between:8,10',
            'cont_usuario' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos, login',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // verificamos que el usuario exista buscandolo de la siguiente forma
        $user = User::where('id_usuario', $request->id_usuario)->first();

        // verificamos que la contrasea sea correcta
        if ($user && Hash::check($request->cont_usuario, $user->cont_usuario)) {
            
            // si la contraseña y el usuario esta correctos se genera el token asi:
            $token = $user->createToken('Token')->accessToken;

            // retornamos el id de usuario y el token, si todo sale correcto
            return response()->json([
                'user' => $user->id_usuario,
                'token' => $token
            ], 200);
        } else {

            // retornamos un mensaje de error en las credenciales
            return response()->json(['mensaje' => 'No tiene autorización'], 401);
        }
        // $credenciales = $request->only('email', 'password');

        // if(Auth::attempt($credenciales)) {
            
        //     //
        //     $user = Auth::user();

        //     //
        //     $token = $user->createToken('Token')->accessToken;

        //     return response()->json ([
        //         'user' => $user->id_usuario,
        //         'token' => $token
        //     ], 200);
            
        // } else {
        //     return response()->json(['mensaje' => 'No tiene autorización'], 200);
        // }

        // if (auth()->attempt($credenciales)) {
        //     $token = auth()->user()->createToken('Token')->accessToken;
        // } else {
        //     return response()->json(['mensaje' => 'Usuario o contraseña incorrecta', 'mensaje2' => $credenciales]);
        // }

        return response()->json(['token' => $token, 'mensaje' => $credenciales], 200);
    }

    // public function logout(){
    //     $token = auth()->user()->token();

    //     $token->revoke();

    //     // $user = auth()->user();

    //     // Revocar todos los tokens del usuario
    //     // $user->tokens()->delete();


    //     return response()->json(['mensaje' => 'Se cerro la Sesion del Usuario']);
    // }

    public function logout(Request $request) {

        dd($request);

        $user = $request->user(); // Obtiene el usuario autenticado
    
        // Revoca el token del usuario
        $user->token()->revoke();
    
        return response()->json(['mensaje' => 'Se cerró la sesión del usuario'], 200);
    }





    // public function register(Request $request) {
    //     $validatedData = $request->validate([
    //         'id_usuario' => 'required',
    //         'cod_rol'=> 'required',
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //         'tele_usuario'=> 'required'
    //     ]);

    //     $validatedData['password'] = Hash::make($request->password);

    //     $user = User::Create($validatedData);

    //     $accessToken = $user->createToken('authToken')->accessToken;

    //     return response([
    //         'user' => $user,
    //         'access_token' => $accessToken
    //     ]);

    // }





    // public function register(Request $request) {
    //     $validatedData = $request->validate([
    //         'id_usuario' => 'required',
    //         'cod_rol'=> 'required',
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //         'tele_usuario'=> 'required'
    //     ]);

    //     $validatedData['password'] = Hash::make($request->password);

    //     $user = User::Create($validatedData);

    //     $accessToken = $user->createToken('authToken')->accessToken;

    //     return response([
    //         'user' => $user,
    //         'access_token' => $accessToken
    //     ]);

    // }

}
