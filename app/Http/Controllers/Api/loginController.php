<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de usuarios con la siguiente direccion
use App\Models\User;
use Illuminate\Database\QueryException;
// Importamos el paquete para encriptar la contraseña
use Illuminate\Support\Facades\Hash;

// Importamos el paquete para autenticar
use Illuminate\Support\Facades\Auth;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    //
    public function registrarse(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'documento' => 'required|string',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'contrasena' => 'required'
        ]);

        // Manejo de errores de validación
        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validación, datos incorrectos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Intento de creación del usuario
        try {
            $usuario = User::create([
                'documento'    => $request->documento,
                'nombre'   => $request->nombre,
                'apellido'   => $request->apellido,
                'email' => $request->email,
                'telefono'  => $request->telefono,
                'contrasena'  => Hash::make($request->contrasena),
                'id_rol'       => 2,
            ]);

            // Se verifica si el usuario fue creado exitosamente
            if (!$usuario) {
                $data = [
                    'mensaje' => 'Error al crear el usuario',
                    'status' => 500
                ];
                return response()->json($data, 500);
            }

            return response()->json($usuario, 200);
        } catch (QueryException $e) {
            // Captura la excepción de duplicado
            if ($e->errorInfo[1] == 1062) { // Código de error SQL para clave duplicada
                return response()->json([
                    'mensaje' => 'El documento o email ya están registrados',
                    'status' => 409
                ], 409);
            }

            // Otros errores de base de datos
            return response()->json([
                'mensaje' => 'Error al crear el usuario',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


    // funcion para realizar el inicio de sesion de los usuarios
    public function login(Request $request)
    {

        // Verificamos los datos que nos estan enviando
        $validator = Validator::make($request->all(), [
            'documento' => 'required',
            'contrasena' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos, login',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // verificamos que el usuario exista buscandolo de la siguiente forma
        $user = User::where('documento', $request->documento)->first();

        if (!$user) {
            return response()->json(['message' => 'Tu usuario no existe en el sistema'], 400);
        }

        // verificamos que la contrasea sea correcta
        if ($user && Hash::check($request->contrasena, $user->contrasena)) {

            // si la contraseña y el usuario esta correctos se genera el token asi:
            $token = $user->createToken('Token')->accessToken;

            // retornamos el id de usuario y el token, si todo sale correcto
            return response()->json([
                'user' => $user->documento,
                'rol' => $user->id_rol,
                'token' => $token
            ], 200);
        } else {

            // retornamos un mensaje de error en las credenciales
            return response()->json(['mensaje' => 'Tu constraseña es incorrecta'], 401);
        }
    }

    public function logout(Request $request)
    {

        // Obtiene el usuario autenticado
        $user = $request->user();

        // Revoca el token del usuario
        $user->token()->revoke();

        return response()->json(['mensaje' => 'Se cerró la sesión del usuario'], 200);
    }
}
