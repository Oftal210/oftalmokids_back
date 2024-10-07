<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Historia Clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el un paquete para hacer validacion o verificacion de datos
use Illuminate\Support\Facades\Validator;


class historiaclinicaController extends Controller
{
    // Funcion para llamar a todos las Historias Clinicas del sistema 
    public function index(){

        // de esta manera buscamos todos las Historias Clinicas del sistema y los pasamos a la variable siguiente
        $historiaclinica = Historia_clinica::all();

        // si la tabla esta vacia o no se encontro nada dentro hara lo siguiente
        if ($historiaclinica->isEmpty()){
            return response()->json(['mensaje' => 'no hay Historias Clinicas registrados en la tabla']);
        }

        // este return devuelve todo lo que contiene la variable de $historiaclinica. El 200 inidica que todo salio bien
        return response()->json($historiaclinica, 200);
    }

    // Funcion para almacenar las Historias Clinicas dentro de la base de datos 
    public function store(Request $request){
        
        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'required|numeric|digits_between:8,10',
            'rol' => 'required|digits:1',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|digits:10',
            'password' => 'required',

            'hijo' =>  'required|numeric|digits_between:8,10',
            'padre' => 'required|numeric|digits_between:8,10',
            'usuario' => 'required|numeric|digits_between:8,10',
            'fecha_consulta' => 'required|date',
            'motivo_consulta' => 'required|string',
            'edad_embarazo_madre' => 'required|digits_between:1,2',
            'fue_alto_riesgo' => 'required|boolean',
            'especifique_riesgo' => 'nullable|string',
            'semanas_gestacion,' => 'required|digits_between:1,2',
            'tipo_parto' => 'required|digits:1',
            'complicaciones_parto' => 'required|boolean',
            'especifique_complicaciones' => 'string',
            'uso_incubadora,' => 'required|boolean',
            'tiempo_incubadora' => 'string', 
            'puntaje_apgar,' => 'required|digits_between:1,2',
            'respiro_lloro_alnacer' => 'required|boolean',
            'emfermedad_en_embarazo' => 'required|boolean',
            'especifque_enfermedad_emb' => 'string',
            'medicamente_en_embarazo,' => 'required|boolean',
            'especifique_medicamento' => 'string',
            'emfermedad_sistemica,' => 'required|boolean',
            'especifique_enfer_sistemica' => 'string',
            'alergia,' => 'required|boolean',
            'especifique_alergia' => 'string',
            'cirugia_general_ocular,' => 'required|string',
            'correcion_optica' => 'required|boolean',
            'edad_lente_prim_vez' => 'digits_between:1,2',
            'cuantos_cambios_rx' => 'digits_between:1,2',
            'motivo_cambios_rx,' => 'required|string',
            'material_trat_optico' => 'string',
            'indicacion_uso,' => 'string',
            'fecha_ultimo_examen,' => 'date',
            'agudeza_visual_test,' => 'required|string',
            'agudeza_visual_distancia' => 'required|string',
            'od_sc_vl' => 'required|string',
            'od_vp' => 'required|string',
            'od_ph' => 'required|string',
            'os_sc_vl' => 'required|string',
            'os_vp' => 'required|string',
            'os_ph' => 'required|string',
            'lensometria_od' => 'required|string',
            'lensometria_os' => 'required|string',
            'od_cc_vl' => 'required|string',
            'od_vp_lenso' => 'required|string',
            'os_cc_vl' => 'required|string',
            'os_vp_lenso' => 'required|string',
            'queratome_od' => 'required|string',
            'queratome_os' => 'required|string',
            'retino_tecnica' => 'required|string',
            'retino_ciclople' => 'required|string',
            'retino_refrac_od' => 'required|string',
            'retino_refrac_os' => 'required|string',
            'retino_subjet_od' => 'required|string',
            'retino_subjet_os' => 'required|string',
            'retino_final_od' => 'required|string',
            'retino_final_os' => 'required|string',
            'test_hirschberg' => 'required|string',
            'test_bruckner' => 'required|string',
            //'angulo_kappa' => // req, text
            'covet_test_vl' => 'required|string',
            'covet_test_vp' => 'required|string',
            'esta_acomo_flex' => 'required|string',
            'esta_acomo_aa' => 'required|string',

            'versi_observaci' => 'required|string',
            'ducc_normal_od' => 'required|string',
            'ducc_parecia_od' => 'required|string',
            'ducc_paralisis_od' => 'required|string',
            'ducc_normal_os' => 'required|string',
            'ducc_parecia_os' => 'required|string',
            'ducc_paralisis_os' => 'required|string',
            'mo_seguimiento_od' => 'required|string',
            'mo_sacadicos_od' => 'required|string',
            'mo_seguimiento_os' => 'required|string',
            'mo_sacadicos_os' => 'required|string',
            'mo_seguimiento_ao' => 'required|string',

            'mo_sacadicos_ao' => 'required|string',
            'explo_exter_od' => 'required|string',
            'explo_exter_os' => 'required|string',
            'medi_refrin_od' => 'required|string',
            'refle_fovea_od' => 'required|string',
            'papila_od' => 'required|string',
            'excav_fisio_od' => 'required|string',
            'profundidad_od' => 'required|string',
            'vasos_od' => 'required|string',
            'rela_arte_od' => 'required|string',
            'macula_od' => 'required|string',
            'reti_perif_od' => 'required|string',
            'medi_refrin_os' => 'required|string',
            'refle_fovea_os' => 'required|string',
            'papila_os' => 'required|string',
            'excav_fisio_os' => 'required|string',
            'profundidad_os' => 'required|string',
            'vasos_os' => 'required|string',
            'rela_arte_os' => 'required|string',
            'macula_os' => 'required|string',
            'reti_perif_os' => 'required|string',

            'diagnostico' => 'required|string',
            'pronostico' => 'required|string',
            'tratamiento' => 'required|string',
            'control_historia_cli' => 'required|string',

        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos historia clinica',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // aqui intentamos crear una Historia Clinica validando que los datos que vamos a agregar existan
        $usuario = Historia_clinica::create([
            'id_usuario'    => $request->documento,
            'cod_rol'       => $request->rol,
            'nom_usuario'   => $request->nombre,
            'ape_usuario'   => $request->apellido,
            'email_usuario' => $request->email,
            'tele_usuario'  => $request->telefono,
            
        ]);

        // aqui validamos si se puedo crear la Historia Clinica, en caso de que este vacia, no se deberia haber guardado
        if(!$usuario) {
            $data = [
                'mensaje' => 'Error al crear el Usuario',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Historia Clinica que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'usuario' => $usuario,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Historia Clinica especifica
    public function show($id){
        
        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $usuario = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Historia Clinica fue encontrado lo colocara dentro de esta variable
        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Historia Clinica
    public function destroy($id){

        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $usuario = Historia_clinica::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Historia Clinica encontrada
        $usuario->delete();

        // si la Historia Clinica fue eliminado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Historia Clinica fue eliminada',
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para actualizar una Historia Clinica
    public function update( Request $request, $id) {

        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $usuario = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$usuario){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            'documento' => 'sometimes|numeric|digits_between:8,10',
            'rol' => 'sometimes|digits:1',
            'nombre' => 'sometimes',
            'apellido' => 'sometimes',
            'email' => 'sometimes|email',
            'telefono' => 'sometimes|digits:10',
            'password' => 'sometimes'
        ]);

        // aqui se mandan los datos que quedaron mal segun la validacion
        if($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion, datos incorrectos Historia Clinica edit',
                'errors' => $validator->errors(), // enviamos en donde o que fue lo que quedo mal
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Se confirma la validacion de los datos en el anteior bloque
        $datosvalidados = $validator->validated();

        // Se Mapean los campos validados a los nombres correctos de la base de datos para que se coloquen donde deben
        $mappedData = [
            'doc_usuario' => $datosvalidados['documento'] ?? $usuario->doc_usuario,
            'cod_rol' => $datosvalidados['rol'] ?? $usuario->cod_rol,
            'nom_usuario' => $datosvalidados['nombre'] ?? $usuario->nom_usuario,
            'ape_usuario' => $datosvalidados['apellido'] ?? $usuario->ape_usuario,
            'email_usuario' => $datosvalidados['email'] ?? $usuario->email_usuario,
            'tele_usuario' => $datosvalidados['telefono'] ?? $usuario->tele_usuario,
            'cont_usuario' => $datosvalidados['password'] ?? $usuario->cont_usuario,
        ];

        // Si la password es parte de los campos enviados, se encriptara antes de agregarla al mapeo
        if (isset($datosvalidados['password'])) {
            $mappedData['cont_usuario'] = bcrypt($datosvalidados['password']);
        }

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $usuario->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $usuario->save();

        // si la Historia Clinica fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Historia Clinica fue actualizada',
            'usuario' => $usuario,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }
}
