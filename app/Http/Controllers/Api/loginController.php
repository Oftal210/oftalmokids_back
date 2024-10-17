<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Mail\VerificationCodeEmail;
use Illuminate\Http\Request;

// Importamos el modelo de usuarios con la siguiente direccion
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
// Importamos el paquete para encriptar la contraseña
use Illuminate\Support\Facades\Hash;

// Importamos el paquete para autenticar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class loginController extends Controller
{
    // falta colocarle protected
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

        $verificationCode = mt_rand(10000, 99999);

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
                'cod_ver' => $verificationCode,
            ]);
            if (!$usuario) {
                $data = [
                    'mensaje' => 'Error al crear el usuario',
                    'status' => 500
                ];
                return response()->json($data, 500);
            }
            Mail::to($request['email'])->send(new VerificationCodeEmail($verificationCode));
            return response()->json([
                'mensage' => 'Usuario registrado. Verifica tu correo para continuar.',
                // 'usuario' => $usuario,
                'email' => $request->email,
                // 'codigo_verificacion' => $verificationCode,
                'status' => 200
            ], 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json([
                    'mensaje' => 'El documento o email ya están registrados',
                    'status' => 409
                ], 409);
            }

            // Otros errores de base de datos
            return response()->json([
                'mensage' => 'Error al crear el usuario',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
        // dd($usuario);
    }

    // falta colocarle protected
    public function validate_email(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'cod_ver' => 'required',
            ]);

            $usuario = User::where('email', $validatedData['email'])->first();

            if (!$usuario) {
                return response()->json([
                    'mensaje' => 'El correo no está registrado',
                    'status' => 404
                ], 404);
            }

            if ($usuario->cod_ver == $request->cod_ver) {
                // Marcar el correo como verificado
                $usuario->email_verified_at = now();
                $usuario->cod_ver = null; // Limpiar el código de verificación
                $usuario->save();

                return response()->json([
                    'mensaje' => 'Correo verificado correctamente',
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'mensaje' => 'El código de verificación es incorrecto',
                    'status' => 400
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al procesar la solicitud: ' . $e->getMessage()], 500);
        }
    }


    public function enviarRecuperarContrasena (Request $request){
        try {
            $email=$request->email;

            if (!$email) {
                return response()->json(['error' => 'Por favor, proporciona un correo'],400);
            }
    
            $user = User::where('email', $email)->first();
    
            if (!$user) {
                return response()->json(['error' => 'Esta cuenta no existe'],400);
            }
            
            $temporaryPassword = Str::random(10);
            $user->contrasena = Hash::make($temporaryPassword);
            $user->temporary_password_created_at = now();
            $user->is_temporary_password = true;
            $user->save();
    
            Mail::to($email)->send(new PasswordReset($temporaryPassword));
            return response()->json(['message' => 'Te hemos enviado un email con tu nueva contraseña temporal. Cámbiala cuando inicies sesión.'], 200);
        
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al procesar la solicitud: ' . $e->getMessage()], 500);
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
