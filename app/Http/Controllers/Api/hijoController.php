<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// Importamos el modelo de hijos con la siguiente direccion
use App\Models\Hijo;
use App\Models\User;

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

        $data = [
            'hijo' => $hijos,
            'status' => 200
        ];

        // este return devuelve todo lo que contiene la variable de $hijos. El 200 inidica que todo salio bien
        return response()->json($data, 200);
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
            'edad'          => 'required|integer',
            'genero'        => 'required|string',
            'direccion'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        $storagePath = storage_path('app/public/imagen-hijo');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true); 
        }

        // Si se recibe una imagen, guardarla
        if ($request->hasFile('foto')) { // IMPORTANTISIMO QUE EL NOMBRE DE LA IMAGEN COINCIDA CON FOTO O QUE TENGA FOTO AL PRINCIPIO
            $imagen = $request->file('foto');
            $path = $imagen->store('imagen-hijo', 'public');
            $path = str_replace('public/', '', $path);
        } else {
            $path = null;  // Si no hay imagen, no asignamos ninguna
        }

        // aqui intentamos crear un Hijo validando que los datos que vamos a agregar existan
        $hijo = Hijo::create([
            'documento'         => $request->documento,
            'id_usuario'        => $request->padre,
            'nombre'            => $request->nombre,
            'apellido'          => $request->apellido,
            'tipo_documento'    => $request->tipodoc,
            'fecha_nacimiento'  => $request->nacimiento,
            'edad'              => $request->edad,
            'genero'            => $request->genero,
            'direccion'         => $request->direccion,
            'foto'              => $path,
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

    // Funcion para buscar un Pacientes cuyo documento sean parecidos
    public function buscardocumentoparecido($id){
        
        // Aqui se busca los Pacientes por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::where('documento', 'like', '%' . $id . '%')->get();

        // Validamos si la variable con la data esta vacia
        if ($hijo->isEmpty()){
            $data = [
                'mensaje' => 'No se encontraron Hijo(s) con ese documento',
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
    public function update(Request $request, $id) {
    
        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al Hijo para actualizar',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'nombre'            => 'sometimes|string|max:70',
            'apellido'          => 'sometimes|string|max:70',
            'tipo_documento'    => 'sometimes|string|max:50',
            'direccion'         => 'sometimes|string|max:70',
            'foto'              => 'nullable|string'
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

        // // Guardar nueva imagen 
        // if ($request->hasFile('foto')) {
            
        //     // revisamos si tiene imagen
        //     if($hijo->foto){
        //         $oldImagePath = storage_path('app/public/' . $hijo->foto); 
        //         if (File::exists($oldImagePath)) {
        //             File::delete($oldImagePath); 
        //         }
        //     }

        //     // guardar la nueva imagen
        //     $imagen = $request->file('foto');
        //     $path = $imagen->store('imagen-hijo', 'public');
        //     $path = str_replace('public/', '', $path);
        // } else {
        //     $path = $hijo->foto; // Mantener la imagen antigua si no se proporciona una nueva
        // }


        // Verificar si se ha recibido la foto
        if ($request->has('foto')) {
            // Obtener la imagen en Base64
            $base64Image = $request->foto;

            // Eliminar la parte de la cadena Base64 que indica el tipo de imagen (data:image/jpeg;base64,)
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

            // Generar un nombre único para la imagen
            $imageName = uniqid() . '.png'; // Puedes cambiar el tipo de archivo según la extensión

            // Guardar la imagen en el almacenamiento público
            $path = storage_path('app/public/imagen-hijo/' . $imageName);

            // Guardar el archivo en el disco
            file_put_contents($path, $imageData);

            // Si es necesario, actualizar la ruta de la imagen en la base de datos
            $path = 'imagen-hijo/' . $imageName;

            if($hijo->foto){
                $oldImagePath = storage_path('app/public/' . $hijo->foto); 
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath); 
                }
            }
        } else {
            // Mantener la imagen anterior si no se proporciona una nueva
            $path = $hijo->foto;
        }


        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'nombre'            => $datosvalidados['nombre'] ?? $hijo->nombre,
            'apellido'          => $datosvalidados['apellido'] ?? $hijo->apellido,
            'tipo_documento'    => $datosvalidados['tipo_documento'] ?? $hijo->tipo_documento,
            'direccion'         => $datosvalidados['direccion'] ?? $hijo->direccion,
            'foto'              => $path ?? $hijo->foto
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $hijo->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $hijo->save();

        // si el Hijo fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Hijo fue actualizado',
            'foto' => $request->foto,
            'nombre' => $request->nombre,
            '$req' => $request,
            'path' => $path,
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
            $data = [
                'mensaje' => 'no hay hijos registrados',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // si el Usuario fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'cantidad' => $cantidadHijos,
            'status' => 200
        ];

        // este return devuelve todo lo que contiene la variable de $hijos. El 200 inidica que todo salio bien
        return response()->json($data, 200); // retornamos el numero de registros que se encontraron
    }

    public function hijosdepadre ($id){

        // Aqui se busca el Padre por la primaria que le estamos mandando como variable $id
        $padre = User::where('documento', $id)
                     ->where('id_rol', 2)
                     ->whereNot('id', 1)->first();;

        // Validamos si la variable con la data esta vacia
        if (!$padre){
            $data = [
                'mensaje' => 'No se encontro al Padre',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // Aquí $usuarios es una colección que contiene todos los registros encontrados
        $hijos = Hijo::where('id_usuario', $padre->id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$hijos){
            $data = [
                'mensaje' => 'No se encontraron hijos del Padre',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($hijos, 200);

    }
}
