<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Importamos el modelo de Diagnostico x historia clinica con la siguiente direccion
use App\Models\Diagnostico_historia_clinica;

// Importamos el modelo de Historia clinica con la siguiente direccion
use App\Models\Historia_clinica;
use App\Models\User;
use App\Models\Hijo;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;

class diagnosticohistoriaclinicaController extends Controller
{
    // Funcion para llamar a todos los Diagnostico x historia clinica del sistema 
    public function index(){

        // de esta manera buscamos todos los Diagnostico x historia clinica del sistema y los pasamos a la variable siguiente
        $diag_his_cli= Diagnostico_historia_clinica::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($diag_his_cli->isEmpty()){
            return response()->json(['mensaje' => 'no hay Diagnostico x historia clinica registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $diag_his_cli. El 200 inidica que todo salio bien
        return response()->json($diag_his_cli, 200);
    }

    // Funcion para almacenar los Diagnostico x historia clinica dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'historia_clinica'          => 'required',
            'diagnostico'               => 'required',
            'motivo_consulta'           => 'required|string',
            'tratamiento_diagnostico'   => 'required|string',
            'pronostico_diagnostico'    => 'required|string',
            'control_diagnostico'       => 'required',
            'edad'                      => 'required'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Diagnostico x historia clinica',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear un Diagnostico x historia clinica validando que los datos que vamos a agregar existan
        $diag_his_cli = Diagnostico_historia_clinica::create([
            'id_historia'       => $request->historia_clinica,
            'id_diagnostico'    => $request->diagnostico,
            'motivo_consulta'   => $request->motivo_consulta,
            'tratamiento'       => $request->tratamiento_diagnostico,
            'pronostico'        => $request->pronostico_diagnostico,
            'control'           => $request->control_diagnostico,
            'edadPaciente'      => $request->edad
        ]);

        // aqui validamos si se puedo crear el Diagnostico x historia clinica, en caso de que este vacia, no se deberia haber guardado
        if(!$diag_his_cli) {
            $data = [
                'mensaje' => 'Error al crear el Diagnostico x historia clinica',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data el Diagnostico x historia clinica que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar un Diagnostico x historia clinica especifico
    public function show($id){
        
        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro el Diagnostico x historia clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si el Diagnostico x historia clinica fue encontrado lo colocara dentro de esta variable
        $data = [
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar un Diagnostico x historia clinica
    public function destroy($id){

        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro al Diagnostico x historia clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar al Diagnostico x historia clinica encontrado 
        $diag_his_cli->delete();

        // si el Diagnostico x historia clinica fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico x historia clinica fue eliminado',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar un Diagnostico x historia clinica
    public function update( Request $request, $id) {

        // Aqui se busca el Diagnostico x historia clinica por la primaria que le estamos mandando como variable $id
        $diag_his_cli = Diagnostico_historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$diag_his_cli){
            $data = [
                'mensaje' => 'No se encontro al Diagnostico x historia clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'motivo_consulta'           => 'sometimes|string',
            'tratamiento_diagnostico'   => 'sometimes|string',
            'pronostico_diagnostico'    => 'sometimes|string',
            'control_diagnostico'       => 'sometimes|string'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Diagnostico x historia clinica edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'motivo_consulta'   => $datosvalidados['motivo_consulta'] ?? $diag_his_cli->motivo_consulta,
            'tratamiento'       => $datosvalidados['tratamiento_diagnostico'] ?? $diag_his_cli->tratamiento,
            'pronostico'        => $datosvalidados['pronostico_diagnostico'] ?? $diag_his_cli->pronostico,
            'control'           => $datosvalidados['control_diagnostico'] ?? $diag_his_cli->control
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $diag_his_cli->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $diag_his_cli->save();

        // si el Diagnostico x historia clinica fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'El Diagnostico x historia clinica fue actualizado',
            'diagnostico_historia_clinica' => $diag_his_cli,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    // Funcion para buscar todos los Diagnosticos de historia clinica realizados x historia clinica
    public function traerdiagnosticoshistoriaclinica($id){
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
        $todosdiagnosticosxhistoria = Diagnostico_historia_clinica::where('id_historia', $id)->get();

        
        // Validamos si la variable con la data esta vacia
        if ($todosdiagnosticosxhistoria->isEmpty()){
            $data = [
                'mensaje' => 'no hay registros con esta historia',
                'status' => 404
            ];
            return response()->json($data, 200);
        }
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($todosdiagnosticosxhistoria, 200);
    }


    // funcion para traer los registros de Diagnosticos Historia Clinica mas recientes deacuerdo al id de la historia clinica
    public function traerdiagnosticosmasreciente($id){
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
        $registroreciente = Diagnostico_historia_clinica::where('id_historia', $id)
                                                        ->latest('fecha')->first();

        // Validamos si la variable con la data esta vacia
        if (!$registroreciente){
            $data = [
                'mensaje' => 'no hay registros recientes con esta historia',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($registroreciente, 200);
    }


    // funcion para traer los registros de Diagnosticos Historia Clinica de este mes
    public function diagnosticosxmes(){

        $primerDiaMes = Carbon::now()->startOfMonth();  // Primer día del mes actual
        $ultimoDiaMes = Carbon::now()->endOfMonth();    // Último día del mes actual
        
        // Buscamos dentro de la tabla la historia clinica mas reciente por id y fecha de insercion
        $registroxmes = Diagnostico_historia_clinica::whereBetween('fecha', [$primerDiaMes, $ultimoDiaMes])->count();

        $data = [
            'mensual' => $registroxmes,
            'status' => 200
        ];
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }


    public function traerRegistroXFecha() {

        // Obtener el año actual
        $yearactual = date('Y');

        // definir los rangos de fechas para cada par de meses
        // Enero - Febrero
        $inicioEneFeb = Carbon::create($yearactual, 1, 1)->startOfDay();
        $finEneFeb = Carbon::create($yearactual, 2, 28)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosEneFeb = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioEneFeb, $finEneFeb])->count();

        // Marzo - Abril
        $inicioMarAbr = Carbon::create($yearactual, 3, 1)->startOfDay();
        $finMarAbr = Carbon::create($yearactual, 4, 30)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosMarAbr = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioMarAbr, $finMarAbr])->count();

        // Mayo - Junio
        $inicioMayJun = Carbon::create($yearactual, 5, 1)->startOfDay();
        $finMayJun = Carbon::create($yearactual, 6, 30)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosMayJun = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioMayJun, $finMayJun])->count();

        // Julio - Agosto
        $inicioJulAgo = Carbon::create($yearactual, 7, 1)->startOfDay();
        $finJulAgo = Carbon::create($yearactual, 8, 31)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosJulAgo = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioJulAgo, $finJulAgo])->count();

        // Septiembre - Octubre
        $inicioSepOct = Carbon::create($yearactual, 9, 1)->startOfDay();
        $finSepOct = Carbon::create($yearactual, 10, 31)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosSepOct = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioSepOct, $finSepOct])->count();

        // Noviembre - Diciembre
        $inicioNovDic = Carbon::create($yearactual, 11, 1)->startOfDay();
        $finNovDic = Carbon::create($yearactual, 12, 31)->endOfDay();
        // realizamos la consulta con las fechas ya determinadas
        $registrosNovDic = Diagnostico_historia_clinica::whereBetween('fecha', [$inicioNovDic, $finNovDic])->count();

        // acumulamos el resultado de las consultas

        $data = [
            'registros' => [
                'Ene_Feb' => $registrosEneFeb,
                'Mar_Abr' => $registrosMarAbr,
                'May_Jun' => $registrosMayJun,
                'Jul_Ago' => $registrosJulAgo,
                'Sep_Oct' => $registrosSepOct,
                'Nov_Dic' => $registrosNovDic
            ],
            'status' => 200
        ];
        
        // retornamos la variable con todas las consultas
        return response()->json($data, 200);
    }

    public function sacarEdadesDiagnosticos(){

        $diagnosticos = DB::table('diagnostico_historia_clinica')
        ->join('diagnostico', 'diagnostico_historia_clinica.id_diagnostico', '=', 'diagnostico.id')
        ->join('hijo', 'diagnostico_historia_clinica.id_hijo', '=', 'hijo.id')
        ->select(
            'diagnostico_historia_clinica.id_diagnostico',
            'diagnostico.codigo as codigo_diagnostico',
            'diagnostico.descripcion as nombre_diagnostico', // Campo nombre del diagnóstico
            DB::raw('COUNT(*) as frecuencia'),
            DB::raw('MIN(hijo.edad) as edad_minima'),
            DB::raw('MAX(hijo.edad) as edad_maxima')
        )
        ->groupBy('diagnostico_historia_clinica.id_diagnostico', 'diagnostico.id')
        ->orderByDesc('frecuencia')
        ->limit(3)
        ->get();
        
        // almacenamos todos los datos contados
        $data = [
            'diag' => $diagnosticos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    

    public function calcularTiempoControl($id){

        $padre = User::where('documento', $id)->first();

        // Validamos si la variable con la data esta vacia
        if (!$padre){
            $data = [
                'mensaje' => 'No se encontro al Padre',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        //
        $hijos = Hijo::where('id_usuario', $padre->id)->get(); 
        

        // Validamos si la variable con la data esta vacia
        if ($hijos->isEmpty()){
            $data = [
                'mensaje' => 'Este padre no cuenta con hijos',
                'status' => 404
            ];
            return response()->json($data, 200);
        }

        // array con todos los id de los hijos del padre
        $hijosIds = $hijos->pluck('id')->toArray();

        // buscamoslos diagnosticos mas recientes de los hijos por su id y traemos el controlde estos
        $diagnosticos = DB::table('diagnostico_historia_clinica as d')
        // Primer join con la subconsulta para obtener el último diagnóstico
        ->join(
            DB::raw('(SELECT id_hijo, MAX(fecha) as ultima_fecha FROM diagnostico_historia_clinica WHERE id_hijo IN (' . implode(',', $hijosIds) . ') GROUP BY id_hijo) as ultimos_diagnosticos'), 
            function($join) {
                $join->on('d.id_hijo', '=', 'ultimos_diagnosticos.id_hijo')
                    ->on('d.fecha', '=', 'ultimos_diagnosticos.ultima_fecha');
            }
        )
        // Segundo join con la tabla hijo para obtener el nombre y apellido
        ->join('hijo as h', 'd.id_hijo', '=', 'h.id') 
        // Selección de campos
        ->select('d.id_hijo', 'd.control', 'd.fecha', 'h.nombre', 'h.apellido')  // Seleccionamos los campos deseados
        // Filtramos por los id_hijo de la lista proporcionada
        ->whereIn('d.id_hijo', $hijosIds)  
        ->get();

        // almacenamos todos los datos contados
        $data = [
            'datos' => $diagnosticos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}
