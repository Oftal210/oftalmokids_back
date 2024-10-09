<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importamos el modelo de Historia Clinica con la siguiente direccion
use App\Models\Historia_clinica;

// Importamos el modelo del Hijo con la siguiente direccion
use App\Models\Hijo;

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
            // Datos iniciales
            'hijo' =>  'required|numeric|digits_between:8,10',
            'padre' => 'required|numeric|digits_between:8,10',
            'usuario' => 'required|numeric|digits_between:8,10',
            'fecha_consulta' => 'required|date',

            // Anamnesis
            'motivo_consulta' => 'required|string',

            // Antecedes medico-personal
            'edad_embarazo_madre' => 'required|digits_between:1,2',
            'fue_alto_riesgo' => 'required|boolean',
            'especifique_riesgo' => 'nullable|string',
            'semanas_gestacion' => 'required|digits_between:1,2',
            'tipo_parto' => 'required|digits:1',
            'complicaciones_parto' => 'required|boolean',
            'especifique_complicaciones' => 'nullable|string',
            'uso_incubadora' => 'required|boolean',
            'tiempo_incubadora' => 'nullable|string', 
            'puntaje_apgar' => 'required|digits_between:1,2',
            'respiro_lloro_alnacer' => 'required|boolean',
            'emfermedad_en_embarazo' => 'required|boolean',
            'especifque_enfermedad_emb' => 'nullable|string',
            'medicamente_en_embarazo' => 'required|boolean',
            'especifique_medicamento' => 'nullable|string',
            'emfermedad_sistemica' => 'required|boolean',
            'especifique_enfer_sistemica' => 'nullable|string',
            'alergia' => 'required|boolean',
            'especifique_alergia' => 'nullable|string',
            'cirugia_general_ocular' => 'required|string',

            //Antecedentes visuales
            'correcion_optica' => 'required|boolean',
            'edad_lente_prim_vez' => 'nullable|digits_between:1,2',
            'cuantos_cambios_rx' => 'nullable|digits_between:1,2',
            'motivo_cambios_rx' => 'required|string',
            'material_trat_optico' => 'nullable|string',
            'indicacion_uso' => 'nullable|string',
            'fecha_ultimo_examen' => 'nullable|date',

            //Agudeza visual
            'agudeza_visual_test' => 'required|string',
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

            //Queratometrica
            'queratome_od' => 'required|string',
            'queratome_os' => 'required|string',

            // Retinoscopia
            'retino_tecnica' => 'required|string',
            'retino_ciclople' => 'required|string',
            'retino_refrac_od' => 'required|string',
            'retino_refrac_os' => 'required|string',
            'retino_subjet_od' => 'required|string',
            'retino_subjet_os' => 'required|string',
            'retino_final_od' => 'required|string',
            'retino_final_os' => 'required|string',

            //Alineamiento motor
            'test_hirschberg' => 'required|string',
            'test_bruckner' => 'required|string',
            'covet_test_vl' => 'required|string',
            'covet_test_vp' => 'required|string',
            'esta_acomo_flex' => 'required|string',
            'esta_acomo_aa' => 'required|string',

            //Versiones
            'versi_observaci' => 'required|string',

            //Ducciones
            'ducc_normal_od' => 'required|string',
            'ducc_parecia_od' => 'required|string',
            'ducc_paralisis_od' => 'required|string',
            'ducc_normal_os' => 'required|string',
            'ducc_parecia_os' => 'required|string',
            'ducc_paralisis_os' => 'required|string',

            //Motilidad ocular
            'mo_seguimiento_od' => 'required|string',
            'mo_sacadicos_od' => 'required|string',
            'mo_seguimiento_os' => 'required|string',
            'mo_sacadicos_os' => 'required|string',
            'mo_seguimiento_ao' => 'required|string',
            'mo_sacadicos_ao' => 'required|string',

            //Exploracion de externos
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

            //Oftalmoscopia
            'medi_refrin_os' => 'required|string',
            'refle_fovea_os' => 'required|string',
            'papila_os' => 'required|string',
            'excav_fisio_os' => 'required|string',
            'profundidad_os' => 'required|string',
            'vasos_os' => 'required|string',
            'rela_arte_os' => 'required|string',
            'macula_os' => 'required|string',
            'reti_perif_os' => 'required|string',

            //Datos finales 
            'diagnostico' => 'required|string',
            'pronostico' => 'required|string',
            'tratamiento' => 'required|string',
            'control_historia_cli' => 'required|string'
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
        $historiaclinica = Historia_clinica::create([
            'id_hijo'                   => $request->hijo,
            'id_padre'                  => $request->padre,
            'id_usuario'                => $request->usuario,
            'fech_consulta'             => $request->fecha_consulta,

            'motivo_consulta'           => $request->motivo_consulta,
            
            'edad_embar_madre'          => $request->edad_embarazo_madre,
            'alto_riesgo'               => $request->fue_alto_riesgo,
            'especif_riesg'             => $request->especifique_riesgo,
            'semanas_gestacion'         => $request->semanas_gestacion,
            'tipo_parto'                => $request->tipo_parto,
            'complicacion'              => $request->complicaciones_parto,
            'especif_compli'            => $request->especifique_complicaciones,     
            'uso_incubadora'            => $request->uso_incubadora,
            'tiempo_incubadora'         => $request->tiempo_incubadora,  
            'apgar_incubadora'          => $request->puntaje_apgar,
            'respir_lloro_nacer'        => $request->respiro_lloro_alnacer,
            'enferme_embarazo'          => $request->emfermedad_en_embarazo,
            'especif_enferme_embar'     => $request->especifque_enfermedad_emb,   
            'medicam_embarazo'          => $request->medicamente_en_embarazo,
            'especif_medicam_embar'     => $request->especifique_medicamento,           
            'enferm_sistemica'          => $request->emfermedad_sistemica,
            'especif_enferm_sistemica'  => $request->especifique_enfer_sistemica,
            'alergia'                   => $request->alergia,
            'especif_alergia'           => $request->especifique_alergia,
            'cirug_gener_ocular'        => $request->cirugia_general_ocular,    
            'correc_optica'             => $request->correcion_optica,
            'edad_lente_prim_vez'       => $request->edad_lente_prim_vez,            
            'cuant_cambio_rx'           => $request->cuantos_cambios_rx,   
            'motiv_cambio_rx'           => $request->motivo_cambios_rx,
            'mater_tratam_optic'        => $request->material_trat_optico,
            'indicaci_uso'              => $request->indicacion_uso,
            'fech_ultim_exam'           => $request->fecha_ultimo_examen,
            'agude_visu_test'           => $request->agudeza_visual_test,
            'agude_visu_distan'         => $request->agudeza_visual_distancia,
            'od_sc_vl'                  => $request->od_sc_vl,
            'od_vp'                     => $request->od_vp,
            'od_ph'                     => $request->od_ph,
            'os_sc_vl'                  => $request->os_sc_vl, 
            'os_vp'                     => $request->os_vp, 
            'os_ph'                     => $request->os_ph, 
            'lensome_od'                => $request->lensometria_od, 
            'lensome_os'                => $request->lensometria_os, 
            'od_cc_vl'                  => $request->od_cc_vl, 
            'od_vp_lenso'               => $request->od_vp_lenso, 
            'os_cc_vl'                  => $request->os_cc_vl, 
            'os_vp_lenso'               => $request->os_vp_lenso, 
            'queratome_od'              => $request->queratome_od,   
            'queratome_os'              => $request->queratome_os, 
            'retino_tecnica'            => $request->retino_tecnica, 
            'retino_ciclople'           => $request->retino_ciclople, 
            'retino_refrac_od'          => $request->retino_refrac_od, 
            'retino_refrac_os'          => $request->retino_refrac_os, 
            'retino_subjet_od'          => $request->retino_subjet_od, 
            'retino_subjet_os'          => $request->retino_subjet_os, 
            'retino_final_od'           => $request->retino_final_od,         
            'retino_final_os'           => $request->retino_final_os, 

            'test_hirschberg'           => $request->test_hirschberg, 
            'test_bruckner'             => $request->test_bruckner, 
            'covet_test_vl'             => $request->covet_test_vl,
            'covet_test_vp'             => $request->covet_test_vp,
            'esta_acomo_flex'           => $request->esta_acomo_flex, 
            'esta_acomo_aa'             => $request->esta_acomo_aa,
            
            'versi_observaci'           => $request->versi_observaci,            

            'ducc_normal_od'            => $request->ducc_normal_od, 
            'ducc_parecia_od'           => $request->ducc_parecia_od, 
            'ducc_paralisis_od'         => $request->ducc_paralisis_od, 
            'ducc_normal_os'            => $request->ducc_normal_os, 
            'ducc_parecia_os'           => $request->ducc_parecia_os, 
            'ducc_paralisis_os'         => $request->ducc_paralisis_os, 

            'mo_seguimiento_od'         => $request->mo_seguimiento_od, 
            'mo_sacadicos_od'           => $request->mo_sacadicos_od, 
            'mo_seguimiento_os'         => $request->mo_seguimiento_os, 
            'mo_sacadicos_os'           => $request->mo_sacadicos_os, 
            'mo_seguimiento_ao'         => $request->mo_seguimiento_ao, 
            'mo_sacadicos_ao'           => $request->mo_sacadicos_ao, 

            'explo_exter_od'            => $request->explo_exter_od, 
            'explo_exter_os'            => $request->explo_exter_os, 
            'medi_refrin_od'            => $request->medi_refrin_od, 
            'refle_fovea_od'            => $request->refle_fovea_od, 
            'papila_od'                 => $request->papila_od, 
            'excav_fisio_od'            => $request->excav_fisio_od, 
            'profundidad_od'            => $request->profundidad_od, 
            'vasos_od'                  => $request->vasos_od, 
            'rela_arte_od'              => $request->rela_arte_od, 
            'macula_od'                 => $request->macula_od,             
            'reti_perif_od'             => $request->reti_perif_od, 


            'medi_refrin_os'            => $request->medi_refrin_os,
            'refle_fovea_os'            => $request->refle_fovea_os, 
            'papila_os'                 => $request->papila_os, 
            'excav_fisio_os'            => $request->excav_fisio_os, 
            'profundidad_os'            => $request->profundidad_os, 
            'vasos_os'                  => $request->vasos_os, 
            'rela_arte_os'              => $request->rela_arte_os, 
            'macula_os'                 => $request->macula_os, 
            'reti_perif_os'             => $request->reti_perif_os, 
                                                    
            'diagnostico'               => $request->diagnostico,     
            'pronostico'                => $request->pronostico,       
            'tratamiento'               => $request->tratamiento, 
            'control_historia_cli'      => $request->control_historia_cli

        ]);

        // aqui validamos si se puedo crear la Historia Clinica, en caso de que este vacia, no se deberia haber guardado
        if(!$historiaclinica) {
            $data = [
                'mensaje' => 'Error al crear la Historia clinica',
                'errors' => $validator->errors(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // aqui colocamos en la variable $data la Historia Clinica que fue agregado y enviamos un 201 (se creo un registro correctamente)
        $data = [
            'historia_clinica' => $historiaclinica,
            'status' => 201
        ];

        // retornamos el resultado de anterior bloque
        return response()->json($data, 201);
    }

    // Funcion para buscar una Historia Clinica especifica
    public function show($id){
        
        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // si la Historia Clinica fue encontrado lo colocara dentro de esta variable
        $data = [
            'historia_clinica' => $historiaclinica,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    // Fucion para elimizar una Historia Clinica
    public function destroy($id){

        // Aqui se busca la Historia Clinica por la primaria que le estamos mandando como variable $id
        $historiaclinica = Historia_clinica::find($id);
        
        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Procedemos a eliminar la Historia Clinica encontrada
        $historiaclinica->delete();

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
        $historiaclinica = Historia_clinica::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$historiaclinica){
            $data = [
                'mensaje' => 'No se encontro la Historia Clinica para eliminar',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // aqui se validan los datos que llegan en la variable $request segunda haga falta
        $validator = Validator::make($request->all(), [
            // Datos iniciales
            'hijo' =>  'sometimes|numeric|digits_between:8,10',
            'padre' => 'sometimes|numeric|digits_between:8,10',
            'usuario' => 'sometimes|numeric|digits_between:8,10',
            'fecha_consulta' => 'sometimes|date',

            // Anamnesis
            'motivo_consulta' => 'sometimes|string',

            // Antecedes medico-personal
            'edad_embarazo_madre' => 'sometimes|digits_between:1,2',
            'fue_alto_riesgo' => 'sometimes|boolean',
            'especifique_riesgo' => 'sometimes|string',
            'semanas_gestacion' => 'sometimes|digits_between:1,2',
            'tipo_parto' => 'sometimes|digits:1',
            'complicaciones_parto' => 'sometimes|boolean',
            'especifique_complicaciones' => 'sometimes|string',
            'uso_incubadora' => 'sometimes|boolean',
            'tiempo_incubadora' => 'sometimes|string', 
            'puntaje_apgar' => 'sometimes|digits_between:1,2',
            'respiro_lloro_alnacer' => 'sometimes|boolean',
            'emfermedad_en_embarazo' => 'sometimes|boolean',
            'especifque_enfermedad_emb' => 'sometimes|string',
            'medicamente_en_embarazo' => 'sometimes|boolean',
            'especifique_medicamento' => 'sometimes|string',
            'emfermedad_sistemica' => 'sometimes|boolean',
            'especifique_enfer_sistemica' => 'sometimes|string',
            'alergia' => 'sometimes|boolean',
            'especifique_alergia' => 'sometimes|string',
            'cirugia_general_ocular' => 'sometimes|string',

            //Antecedentes visuales
            'correcion_optica' => 'sometimes|boolean',
            'edad_lente_prim_vez' => 'sometimes|digits_between:1,2',
            'cuantos_cambios_rx' => 'sometimes|digits_between:1,2',
            'motivo_cambios_rx' => 'sometimes|string',
            'material_trat_optico' => 'sometimes|string',
            'indicacion_uso' => 'sometimes|string',
            'fecha_ultimo_examen' => 'sometimes|date',

            //Agudeza visual
            'agudeza_visual_test' => 'sometimes|string',
            'agudeza_visual_distancia' => 'sometimes|string',
            'od_sc_vl' => 'sometimes|string',
            'od_vp' => 'sometimes|string',
            'od_ph' => 'sometimes|string',
            'os_sc_vl' => 'sometimes|string',
            'os_vp' => 'sometimes|string',
            'os_ph' => 'sometimes|string',
            'lensometria_od' => 'sometimes|string',
            'lensometria_os' => 'sometimes|string',
            'od_cc_vl' => 'sometimes|string',
            'od_vp_lenso' => 'sometimes|string',
            'os_cc_vl' => 'sometimes|string',
            'os_vp_lenso' => 'sometimes|string',

            //Queratometrica
            'queratome_od' => 'sometimes|string',
            'queratome_os' => 'sometimes|string',

            // Retinoscopia
            'retino_tecnica' => 'sometimes|string',
            'retino_ciclople' => 'sometimes|string',
            'retino_refrac_od' => 'sometimes|string',
            'retino_refrac_os' => 'sometimes|string',
            'retino_subjet_od' => 'sometimes|string',
            'retino_subjet_os' => 'sometimes|string',
            'retino_final_od' => 'sometimes|string',
            'retino_final_os' => 'sometimes|string',

            //Alineamiento motor
            'test_hirschberg' => 'sometimes|string',
            'test_bruckner' => 'sometimes|string',
            'covet_test_vl' => 'sometimes|string',
            'covet_test_vp' => 'sometimes|string',
            'esta_acomo_flex' => 'sometimes|string',
            'esta_acomo_aa' => 'sometimes|string',

            //Versiones
            'versi_observaci' => 'sometimes|string',

            //Ducciones
            'ducc_normal_od' => 'sometimes|string',
            'ducc_parecia_od' => 'sometimes|string',
            'ducc_paralisis_od' => 'sometimes|string',
            'ducc_normal_os' => 'sometimes|string',
            'ducc_parecia_os' => 'sometimes|string',
            'ducc_paralisis_os' => 'sometimes|string',

            //Motilidad ocular
            'mo_seguimiento_od' => 'sometimes|string',
            'mo_sacadicos_od' => 'sometimes|string',
            'mo_seguimiento_os' => 'sometimes|string',
            'mo_sacadicos_os' => 'sometimes|string',
            'mo_seguimiento_ao' => 'sometimes|string',
            'mo_sacadicos_ao' => 'sometimes|string',

            //Exploracion de externos
            'explo_exter_od' => 'sometimes|string',
            'explo_exter_os' => 'sometimes|string',
            'medi_refrin_od' => 'sometimes|string',
            'refle_fovea_od' => 'sometimes|string',
            'papila_od' => 'sometimes|string',
            'excav_fisio_od' => 'sometimes|string',
            'profundidad_od' => 'sometimes|string',
            'vasos_od' => 'sometimes|string',
            'rela_arte_od' => 'sometimes|string',
            'macula_od' => 'sometimes|string',
            'reti_perif_od' => 'sometimes|string',

            //Oftalmoscopia
            'medi_refrin_os' => 'sometimes|string',
            'refle_fovea_os' => 'sometimes|string',
            'papila_os' => 'sometimes|string',
            'excav_fisio_os' => 'sometimes|string',
            'profundidad_os' => 'sometimes|string',
            'vasos_os' => 'sometimes|string',
            'rela_arte_os' => 'sometimes|string',
            'macula_os' => 'sometimes|string',
            'reti_perif_os' => 'sometimes|string',

            //Datos finales 
            'diagnostico' => 'sometimes|string',
            'pronostico' => 'sometimes|string',
            'tratamiento' => 'sometimes|string',
            'control_historia_cli' => 'sometimes|string'
            
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
            'id_hijo' => $datosvalidados['hijo'] ?? $historiaclinica->id_hijo,
            'id_padre' => $datosvalidados['padre'] ?? $historiaclinica->id_padre,
            'id_usuario' => $datosvalidados['usuario'] ?? $historiaclinica->id_usuario,
            'fech_consulta' => $datosvalidados['fecha_consulta'] ?? $historiaclinica->fech_consulta,
            'motivo_consulta' => $datosvalidados['motivo_consulta'] ?? $historiaclinica->motivo_consulta,
            'edad_embar_madre' => $datosvalidados['edad_embarazo_madre'] ?? $historiaclinica->edad_embar_madre,
            'alto_riesgo' => $datosvalidados['fue_alto_riesgo'] ?? $historiaclinica->alto_riesgo,
            'especif_riesg' => $datosvalidados['especifique_riesgo'] ?? $historiaclinica->especif_riesg,
            'semanas_gestacion' => $datosvalidados['semanas_gestacion'] ?? $historiaclinica->semanas_gestacion,
            'tipo_parto' => $datosvalidados['tipo_parto'] ?? $historiaclinica->tipo_parto,
            'complicacion' => $datosvalidados['complicaciones_parto'] ?? $historiaclinica->complicacion,
            'especif_compli' => $datosvalidados['especifique_complicaciones'] ?? $historiaclinica->especif_compli,
            'uso_incubadora' => $datosvalidados['uso_incubadora'] ?? $historiaclinica->uso_incubadora,
            'tiempo_incubadora' => $datosvalidados['tiempo_incubadora'] ?? $historiaclinica->tiempo_incubadora,
            'apgar_incubadora' => $datosvalidados['puntaje_apgar'] ?? $historiaclinica->apgar_incubadora,
            'respir_lloro_nacer' => $datosvalidados['respiro_lloro_alnacer'] ?? $historiaclinica->respir_lloro_nacer,
            'enferme_embarazo' => $datosvalidados['emfermedad_en_embarazo'] ?? $historiaclinica->enferme_embarazo,
            'especif_enferme_embar' => $datosvalidados['especifque_enfermedad_emb'] ?? $historiaclinica->especif_enferme_embar,
            'medicam_embarazo' => $datosvalidados['medicamente_en_embarazo'] ?? $historiaclinica->medicam_embarazo,
            'especif_medicam_embar' => $datosvalidados['especifique_medicamento'] ?? $historiaclinica->especif_medicam_embar,
            'enferm_sistemica' => $datosvalidados['emfermedad_sistemica'] ?? $historiaclinica->enferm_sistemica,
            'especif_enferm_sistemica' => $datosvalidados['especifique_enfer_sistemica'] ?? $historiaclinica->especif_enferm_sistemica,
            'alergia' => $datosvalidados['alergia'] ?? $historiaclinica->alergia,
            'especif_alergia' => $datosvalidados['especifique_alergia'] ?? $historiaclinica->especif_alergia,
            'cirug_gener_ocular' => $datosvalidados['cirugia_general_ocular'] ?? $historiaclinica->cirug_gener_ocular,
            'correc_optica' => $datosvalidados['correcion_optica'] ?? $historiaclinica->correc_optica,
            'edad_lente_prim_vez' => $datosvalidados['edad_lente_prim_vez'] ?? $historiaclinica->edad_lente_prim_vez,
            'cuant_cambio_rx' => $datosvalidados['cuantos_cambios_rx'] ?? $historiaclinica->cuant_cambio_rx,
            'motiv_cambio_rx' => $datosvalidados['motivo_cambios_rx'] ?? $historiaclinica->motiv_cambio_rx,
            'mater_tratam_optic' => $datosvalidados['material_trat_optico'] ?? $historiaclinica->mater_tratam_optic,
            'indicaci_uso' => $datosvalidados['indicacion_uso'] ?? $historiaclinica->indicaci_uso,
            'fech_ultim_exam' => $datosvalidados['fecha_ultimo_examen'] ?? $historiaclinica->fech_ultim_exam,
            'agude_visu_test' => $datosvalidados['agudeza_visual_test'] ?? $historiaclinica->agude_visu_test,
            'agude_visu_distan' => $datosvalidados['agudeza_visual_distancia'] ?? $historiaclinica->agude_visu_distan,
            'od_sc_vl' => $datosvalidados['od_sc_vl'] ?? $historiaclinica->od_sc_vl,
            'od_vp' => $datosvalidados['od_vp'] ?? $historiaclinica->od_vp,
            'od_ph' => $datosvalidados['od_ph'] ?? $historiaclinica->od_ph,
            'os_sc_vl' => $datosvalidados['os_sc_vl'] ?? $historiaclinica->os_sc_vl,
            'os_vp' => $datosvalidados['os_vp'] ?? $historiaclinica->os_vp,
            'os_ph' => $datosvalidados['os_ph'] ?? $historiaclinica->os_ph,
            'lensome_od' => $datosvalidados['lensometria_od'] ?? $historiaclinica->lensome_od,
            'lensome_os' => $datosvalidados['lensometria_os'] ?? $historiaclinica->lensome_os,
            'od_cc_vl' => $datosvalidados['od_cc_vl'] ?? $historiaclinica->od_cc_vl,
            'od_vp_lenso' => $datosvalidados['od_vp_lenso'] ?? $historiaclinica->od_vp_lenso,
            'os_cc_vl' => $datosvalidados['os_cc_vl'] ?? $historiaclinica->os_cc_vl,
            'os_vp_lenso' => $datosvalidados['os_vp_lenso'] ?? $historiaclinica->os_vp_lenso,
            'queratome_od' => $datosvalidados['queratome_od'] ?? $historiaclinica->queratome_od,
            'queratome_os' => $datosvalidados['queratome_os'] ?? $historiaclinica->queratome_os,
            'retino_tecnica' => $datosvalidados['retino_tecnica'] ?? $historiaclinica->retino_tecnica,
            'retino_ciclople' => $datosvalidados['retino_ciclople'] ?? $historiaclinica->retino_ciclople,
            'retino_refrac_od' => $datosvalidados['retino_refrac_od'] ?? $historiaclinica->retino_refrac_od,
            'retino_refrac_os' => $datosvalidados['retino_refrac_os'] ?? $historiaclinica->retino_refrac_os,
            'retino_subjet_od' => $datosvalidados['retino_subjet_od'] ?? $historiaclinica->retino_subjet_od,
            'retino_subjet_os' => $datosvalidados['retino_subjet_os'] ?? $historiaclinica->retino_subjet_os,
            'retino_final_od' => $datosvalidados['retino_final_od'] ?? $historiaclinica->retino_final_od,
            'retino_final_os' => $datosvalidados['retino_final_os'] ?? $historiaclinica->retino_final_os,
            'test_hirschberg' => $datosvalidados['test_hirschberg'] ?? $historiaclinica->test_hirschberg,
            'test_bruckner' => $datosvalidados['test_bruckner'] ?? $historiaclinica->test_bruckner,
            'covet_test_vl' => $datosvalidados['covet_test_vl'] ?? $historiaclinica->covet_test_vl,
            'covet_test_vp' => $datosvalidados['covet_test_vp'] ?? $historiaclinica->covet_test_vp,
            'esta_acomo_flex' => $datosvalidados['esta_acomo_flex'] ?? $historiaclinica->esta_acomo_flex,
            'esta_acomo_aa' => $datosvalidados['esta_acomo_aa'] ?? $historiaclinica->esta_acomo_aa,
            'versi_observaci' => $datosvalidados['versi_observaci'] ?? $historiaclinica->versi_observaci,
            'ducc_normal_od' => $datosvalidados['ducc_normal_od'] ?? $historiaclinica->ducc_normal_od,
            'ducc_parecia_od' => $datosvalidados['ducc_parecia_od'] ?? $historiaclinica->ducc_parecia_od,
            'ducc_paralisis_od' => $datosvalidados['ducc_paralisis_od'] ?? $historiaclinica->ducc_paralisis_od,
            'ducc_normal_os' => $datosvalidados['ducc_normal_os'] ?? $historiaclinica->ducc_normal_os,
            'ducc_parecia_os' => $datosvalidados['ducc_parecia_os'] ?? $historiaclinica->ducc_parecia_os,
            'ducc_paralisis_os' => $datosvalidados['ducc_paralisis_os'] ?? $historiaclinica->ducc_paralisis_os,
            'mo_seguimiento_od' => $datosvalidados['mo_seguimiento_od'] ?? $historiaclinica->mo_seguimiento_od,
            'mo_sacadicos_od' => $datosvalidados['mo_sacadicos_od'] ?? $historiaclinica->mo_sacadicos_od,
            'mo_seguimiento_os' => $datosvalidados['mo_seguimiento_os'] ?? $historiaclinica->mo_seguimiento_os,
            'mo_sacadicos_os' => $datosvalidados['mo_sacadicos_os'] ?? $historiaclinica->mo_sacadicos_os,
            'mo_seguimiento_ao' => $datosvalidados['mo_seguimiento_ao'] ?? $historiaclinica->mo_seguimiento_ao,
            'mo_sacadicos_ao' => $datosvalidados['mo_sacadicos_ao'] ?? $historiaclinica->mo_sacadicos_ao,
            'explo_exter_od' => $datosvalidados['explo_exter_od'] ?? $historiaclinica->explo_exter_od,
            'explo_exter_os' => $datosvalidados['explo_exter_os'] ?? $historiaclinica->explo_exter_os,
            'medi_refrin_od' => $datosvalidados['medi_refrin_od'] ?? $historiaclinica->medi_refrin_od,
            'refle_fovea_od' => $datosvalidados['refle_fovea_od'] ?? $historiaclinica->refle_fovea_od,
            'papila_od' => $datosvalidados['papila_od'] ?? $historiaclinica->papila_od,
            'excav_fisio_od' => $datosvalidados['excav_fisio_od'] ?? $historiaclinica->excav_fisio_od,
            'profundidad_od' => $datosvalidados['profundidad_od'] ?? $historiaclinica->profundidad_od,
            'vasos_od' => $datosvalidados['vasos_od'] ?? $historiaclinica->vasos_od,
            'rela_arte_od' => $datosvalidados['rela_arte_od'] ?? $historiaclinica->rela_arte_od,
            'macula_od' => $datosvalidados['macula_od'] ?? $historiaclinica->macula_od,
            'reti_perif_od' => $datosvalidados['reti_perif_od'] ?? $historiaclinica->reti_perif_od,
            'medi_refrin_os' => $datosvalidados['medi_refrin_os'] ?? $historiaclinica->medi_refrin_os,
            'refle_fovea_os' => $datosvalidados['refle_fovea_os'] ?? $historiaclinica->refle_fovea_os,
            'papila_os' => $datosvalidados['papila_os'] ?? $historiaclinica->papila_os,
            'excav_fisio_os' => $datosvalidados['excav_fisio_os'] ?? $historiaclinica->excav_fisio_os,
            'profundidad_os' => $datosvalidados['profundidad_os'] ?? $historiaclinica->profundidad_os,
            'vasos_os' => $datosvalidados['vasos_os'] ?? $historiaclinica->vasos_os,
            'rela_arte_os' => $datosvalidados['rela_arte_os'] ?? $historiaclinica->rela_arte_os,
            'macula_os' => $datosvalidados['macula_os'] ?? $historiaclinica->macula_os,
            'reti_perif_os' => $datosvalidados['reti_perif_os'] ?? $historiaclinica->reti_perif_os,
            'diagnostico' => $datosvalidados['diagnostico'] ?? $historiaclinica->diagnostico,
            'pronostico' => $datosvalidados['pronostico'] ?? $historiaclinica->pronostico,
            'tratamiento' => $datosvalidados['tratamiento'] ?? $historiaclinica->tratamiento,
            'control_historia_cli' => $datosvalidados['control_historia_cli'] ?? $historiaclinica->control_historia_cli
        ];

        // Actualiza solo los campos proporcionados en la solicitud del mapeo para que contenga los nombres correctos de los atributos
        $historiaclinica->fill($mappedData);

        // Despues de tomar y organizar los datos, los guardamos de la siguiente forma
        $historiaclinica->save();

        // si la Historia Clinica fue actualizado correctamente, se cargara la siguiente variable con los datos de:
        $data = [
            'mensaje' => 'La Historia Clinica fue actualizada',
            'historia_clinica' => $historiaclinica,
            'status' => 200
        ];
        
        // Retornamos los datos obtenidos anteriormente
        return response()->json($data, 200);
    }

    public function historiasdelhijo ($id){

        // Aqui se busca el Hijo por la primaria que le estamos mandando como variable $id
        $hijo = Hijo::find($id);

        // Validamos si la variable con la data esta vacia
        if (!$hijo){
            $data = [
                'mensaje' => 'No se encontro al hijo',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Aquí $hijohistorias es una colección que contiene todos los registros encontrados
        $hijohistorias = Historia_clinica::where('id_hijo', $id)->get();

        // Validamos si la variable con la data esta vacia
        if (!$hijohistorias){
            $data = [
                'mensaje' => 'No se encontraron historias clinicas del Hijo enviado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Retornamos los datos obtenidos anteriormente
        return response()->json($hijohistorias, 200);
    }
}
