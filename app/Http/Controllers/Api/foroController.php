<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de foros con la siguiente direccion
use App\Models\Foro;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

// Importamos el paquete para realizar hash en la contraseña
use Illuminate\Support\Facades\Hash;

class foroController extends Controller
{
    // Funcion para llamar a todos los foros del sistema -- se usa la tabla de foros en vez de la de user por ahora
    public function index(){

        // de esta manera buscamos todos los foros del sistema y los pasamos a la variable siguiente
        $foros = Foro::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($foros->isEmpty()){
            return response()->json(['mensaje' => 'no hay foros registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $foros. El 200 inidica que todo salio bien
        return response()->json($foros, 200);
    }

    // Funcion para almacenar los foros dentro de la base de datos
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'subtitulo' => 'required',
            'contenido' => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos foro',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un foros validando que los datos que vamos a agregar existan
        $foro = Foro::create([
            'subtitulo_foro'    => $request->subtitulo,
            'contenido_foro'       => $request->contenido
        ]);

        // aqui validamos si se puedo crear el Foro, en caso de que este vacia, no se deberia haber guardado
        if(!$foro) {
            $data = [
                'mensaje' => 'Error al crear el foro',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el foro que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'foro' => $foro,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Foro especifico
    public function show($id){
        
        // Aqui se busca el Foro por la primaria que le estamos mandando como variable $id
        $foro = Foro::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$foro){
            $data = [
                'mensaje' => 'No se encontro al foro',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el foro fue encontrado lo colocara dentor de esta variable
        $data = [
            'foro' => $foro,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un foro
    public function destroy($id){

        // Aqui se busca el foro por la primaria que le estamos mandando como variable $id
        $foro = Foro::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$foro){
            $data = [
                'mensaje' => 'No se encontro al foro para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al foro encontrado 
        $foro->delete();

        // si el foro fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El foro fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un foro
    public function update( Request $request, $id) {

        // Aqui se busca el foro por la primaria que le estamos mandando como variable $id
        $foro = Foro::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$foro){
            $data = [
                'mensaje' => 'No se encontro al Foro para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'subtitulo' => 'sometimes',
            'contenido' => 'sometimes'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos foro edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'subtitulo_foro' => $datosvalidados['subtitulo'] ?? $foro->subtitulo_foro,
            'contenido_foro' => $datosvalidados['contenido'] ?? $foro->contenido_foro
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $foro->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $foro->save();

        // si el Foro fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Foro fue actualizado',
            'foro' => $foro,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}