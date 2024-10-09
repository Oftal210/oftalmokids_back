<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historia_clinica', function (Blueprint $table) {

            // Datos iniciales ↓
            // identificador de la historia clinica
            $table->bigIncrements('cod_historia')->primary();

            // foranea de la tabla hijo, idenficador del hijo al que pertenece esta historia clinica
            $table->integer('id_hijo')->nullable(false);

            // foranea de la tabla padre, idenficador del padre al que pertenece el hijo
            $table->integer('id_padre')->nullable(false);

            // foranea de la tabla usuario, idenficador del usuario que realiza la consulta
            $table->integer('id_usuario')->nullable(false);

            // fecha en la que se realiza la consulta y se genera el registro de la historia clinica
            $table->date('fech_consulta')->nullable(false);

            // Anamnesis ↓ 
            // motivo de la consulta
            $table->text('motivo_consulta')->nullable(false);

            // Antecedes medico-personales ↓
            // edad en que la madre se embarazo
            $table->integer('edad_embar_madre')->nullable(false);

            // si el embarazo fue o no de alto riesgo (TRUE = SI  |  FALSE = NO)             
            $table->boolean('alto_riesgo')->nullable(false);

            // especifique porque fue de alto riesgo el embarazo (Si el dato anterior fue TRUE o SI)          
            $table->text('especif_riesg')->nullable();

            // semanas de gestacion                       
            $table->integer('semanas_gestacion')->nullable(false);

            // el tipo de parto que tuvo               
            $table->integer('tipo_parto')->nullable(false);

            // si hubo o no complicaciones (TRUE = SI  |  FALSE = NO)               
            $table->boolean('complicacion')->nullable(false);

            // especifique porque hubieron complicaciones en el embarazo (Si el dato anterior fue TRUE o SI)           
            $table->text('especif_compli')->nullable();

            // si uso o no incubadora (TRUE = SI  |  FALSE = NO)                       
            $table->boolean('uso_incubadora')->nullable(false);

            // cuanto tiempo uso la incubadora (Si el dato anterior fue TRUE o SI)           
            $table->string('tiempo_incubadora')->nullable();

            // puntaje de la prueba que se les realiza a los recien nacidos, PRUEBA DE APGAR                        
            $table->integer('apgar_incubadora')->nullable(false);

            // si respiro y lloro al nacer o no (TRUE = SI  |  FALSE = NO)               
            $table->boolean('respir_lloro_nacer')->nullable(false);

            // si presento o no enfermedades durante el embarazo           
            $table->boolean('enferme_embarazo')->nullable(false);

            // que enfermedades presento durante el embarazo (Si el dato anterior fue TRUE o SI)           
            $table->text('especif_enferme_embar')->nullable();

            // uso/tomo o no medicamento/droga durante el embarazo                       
            $table->boolean('medicam_embarazo')->nullable(false);

            // que medicamento/droga uso/tomo durante el embarazo (Si el dato anterior fue TRUE o SI)           
            $table->text('especif_medicam_embar')->nullable();

            // si presento o no alguna enfermedad sistemica                       
            $table->boolean('enferm_sistemica')->nullable(false);

            // que enfermedad/es presento (Si el dato anterior fue TRUE o SI)           
            $table->text('especif_enferm_sistemica')->nullable();

            // si presenta/tiene o no alergias                       
            $table->boolean('alergia')->nullable(false);

            // que alergias presenta/tiene           
            $table->text('especif_alergia')->nullable();

            // a que cirugias general ocular se ha sometido                        
            $table->text('cirug_gener_ocular')->nullable(false);            

            // Antecedentes visuales ↓
            // si utiliza o no correciones opticas
            $table->boolean('correc_optica')->nullable(false);          

            // a que edad utilizo lentes por primera vez (se espera un numero de maximo 2 cifras)
            $table->integer('edad_lente_prim_vez')->nullable();                       

            // cuantos cambios rx ha tenido (se refiere al numero de recetas diferentes que ha tenido)
            $table->integer('cuant_cambio_rx')->nullable();                       

            // motivo del cambio rx que ha tenido
            $table->text('motiv_cambio_rx')->nullable(false);             

            // material y tratamiento optico que ha tenido
            $table->text('mater_tratam_optic')->nullable();                      

            // indicaciones de uso  para el tratamiento que ha tenido
            $table->text('indicaci_uso')->nullable();                     

            // fecha del ultimo examen realizado (oftalmologia)
            $table->date('fech_ultim_exam')->nullable();
            
            // Agudeza visual  (OD = ojo derecho  |  OS = ojo izquierdo)
            // test de agudeza visual a usar
            $table->string('agude_visu_test', 150)->nullable(false);

            // distancia del test de agudeza visual
            $table->string('agude_visu_distan', 150)->nullable(false);

            // resultado del encabezado sc vl de la tabla para el ojo derecho
            $table->string('od_sc_vl', 150)->nullable(false);

            // resultado del encabezado vp de la tabla para el ojo derecho
            $table->string('od_vp', 150)->nullable(false);

            // resultado del encabezado ph de la tabla para el ojo derecho
            $table->string('od_ph', 150)->nullable(false);

            // resultado del encabezado sc vl de la tabla para el ojo izquierdo
            $table->string('os_sc_vl', 150)->nullable(false);

            // resultado del encabezado vp de la tabla para el ojo izquierdo
            $table->string('os_vp', 150)->nullable(false);

            // resultado del encabezado ph de la tabla para el ojo izquierdo
            $table->string('os_ph', 150)->nullable(false);

            // resultado de lensometria del ojo derecho
            $table->string('lensome_od', 150)->nullable(false);

            // resultado de lensometria del ojo izquierdo
            $table->string('lensome_os', 150)->nullable(false);

            // resultado del encabezado cc vl de la tabla para el ojo derecho
            $table->string('od_cc_vl', 150)->nullable(false);

            // resultado del encabezado vp debajo de lensometria de la tabla para el ojo derecho
            $table->string('od_vp_lenso', 150)->nullable(false);

            // resultado del encabezado cc vl de la tabla para el ojo izquierdo
            $table->string('os_cc_vl', 150)->nullable(false);

            // resultado del encabezado vp debajo de lensometria de la tabla para el ojo izquierdo
            $table->string('os_vp_lenso', 150)->nullable(false);

            // Queratometrica
            // resultado de la queratometria del ojo derecho
            $table->string('queratome_od', 150)->nullable(false);  
            
            // resultado de la queratometria del ojo izquierdo
            $table->string('queratome_os', 150)->nullable(false);

            // Retinoscopia
            // tecnica usada para la retinoscopia
            $table->string('retino_tecnica', 150)->nullable(false);

            // resultado cicloplegico de la retinoscopia
            $table->string('retino_ciclople', 150)->nullable(false);

            // resultado de la refraccion para el ojo derecho
            $table->string('retino_refrac_od', 150)->nullable(false);

            // resultado de la refraccion para el ojo izquierdo
            $table->string('retino_refrac_os', 150)->nullable(false);

            // resultado del subjetivo para el ojo derecho
            $table->string('retino_subjet_od', 150)->nullable(false);

            // resultado del subjetivo para el ojo izquierdo
            $table->string('retino_subjet_os', 150)->nullable(false);

            // resultado del final para el ojo derecho
            $table->string('retino_final_od', 150)->nullable(false);
    
            // resultado del final para el ojo izquierdo
            $table->string('retino_final_os', 150)->nullable(false);

            // Alineamiento motor
            // resultado del test de hirschberg
            $table->string('test_hirschberg', 150)->nullable(false);

            // resultado del test de bruckner
            $table->string('test_bruckner', 150)->nullable(false);

            // resultado del test del angulo kappa
            //$table->string('angulo_kappa', 150)->nullable(false);

            // resultado del covet test para vl (vision lejana)
            $table->string('covet_test_vl', 150)->nullable(false);

            // resultado del covet test para vp (vision proxima)
            $table->string('covet_test_vp', 150)->nullable(false);

            // resultado del estado acomodativo para flex
            $table->string('esta_acomo_flex', 150)->nullable(false);

            // resultado del estado acomodativo para aa
            $table->string('esta_acomo_aa', 150)->nullable(false);

            // Versiones
            // observaciones para la seccion de versiones de la historia clinica
            $table->text('versi_observaci')->nullable(false);            

            // Ducciones
            // resultado de la fila normal del encabezado OD
            $table->string('ducc_normal_od', 150)->nullable(false);

            // resultado de la fila parecia del encabezado OD
            $table->string('ducc_parecia_od', 150)->nullable(false);

            // resultado de la fila paralisis del encabezado OD
            $table->string('ducc_paralisis_od', 150)->nullable(false);

            // resultado de la fila normal del encabezado OS
            $table->string('ducc_normal_os', 150)->nullable(false);

            // resultado de la fila parecia del encabezado OS
            $table->string('ducc_parecia_os', 150)->nullable(false);

            // resultado de la fila paralisis del encabezado OS
            $table->string('ducc_paralisis_os', 150)->nullable(false);

            // Motilidad ocular
            // resultado de la fila seguimiento del encabezado OD
            $table->string('mo_seguimiento_od', 150)->nullable(false);

            // resultado de la fila sacadicos del encabezado OD
            $table->string('mo_sacadicos_od', 150)->nullable(false);

            // resultado de la fila seguimiento del encabezado OS
            $table->string('mo_seguimiento_os', 150)->nullable(false);

            // resultado de la fila sacadicos del encabezado OS
            $table->string('mo_sacadicos_os', 150)->nullable(false);

            // resultado de la fila seguimiento del encabezado AO
            $table->string('mo_seguimiento_ao', 150)->nullable(false);

            // resultado de la fila sacadicos del encabezado AO
            $table->string('mo_sacadicos_ao', 150)->nullable(false);

            // Exploracion de externos
            // resultado de exploracion de externos para el ojo derecho
            $table->string('explo_exter_od', 150)->nullable(false);
            
            // resultado de exploracion de externos para el ojo izquierdo
            $table->string('explo_exter_os', 150)->nullable(false);

            // Oftalmoscopia
            // resultado de Medios Refringentes para el ojo derecho
            $table->string('medi_refrin_od', 150)->nullable(false);

            // resultado de Reflejo fovea para el ojo derecho
            $table->string('refle_fovea_od', 150)->nullable(false);

            // resultado de Papila para el ojo derecho
            $table->string('papila_od', 150)->nullable(false);

            // resultado de Excavacion fisiologica para el ojo derecho
            $table->string('excav_fisio_od', 150)->nullable(false);

            // resultado de Profundidad para el ojo derecho
            $table->string('profundidad_od', 150)->nullable(false);

            // resultado de Vasos para el ojo derecho
            $table->string('vasos_od', 150)->nullable(false);

            // resultado de Relacion arteria-vena para el ojo derecho
            $table->string('rela_arte_od', 150)->nullable(false);

            // resultado de Macula para el ojo derecho
            $table->string('macula_od', 150)->nullable(false);

            // resultado de Retina periferica para el ojo derecho
            $table->string('reti_perif_od', 150)->nullable(false);

            // resultado de Medios Refringentes para el ojo izquierdo
            $table->string('medi_refrin_os', 150)->nullable(false);

            // resultado de Reflejo fovea para el ojo izquierdo
            $table->string('refle_fovea_os', 150)->nullable(false);

            // resultado de Papila para el ojo izquierdo
            $table->string('papila_os', 150)->nullable(false);

            // resultado de Excavacion fisiologica para el ojo izquierdo
            $table->string('excav_fisio_os', 150)->nullable(false);

            // resultado de Profundidad para el ojo izquierdo
            $table->string('profundidad_os', 150)->nullable(false);

            // resultado de Vasos para el ojo izquierdo
            $table->string('vasos_os', 150)->nullable(false);

            // resultado de Relacion arteria-vena para el ojo izquierdo
            $table->string('rela_arte_os', 150)->nullable(false);

            // resultado de Macula para el ojo izquierdo
            $table->string('macula_os', 150)->nullable(false);

            // resultado de Retina periferica para el ojo izquierdo
            $table->string('reti_perif_os', 150)->nullable(false);

            // Datos finales 
            // resultado del diagnostico
            $table->text('diagnostico')->nullable(false);         

            // resultado del pronostico
            $table->text('pronostico')->nullable(false);          

            // resultado del tratamiento
            $table->text('tratamiento')->nullable(false);        

            // resultado de los controles o fechas
            $table->string('control_historia_cli', 150)->nullable(false);    

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a hijo
            $table->foreign('id_hijo')->references('id_hijo')->on('hijo');
            // se define la llave foranea en esta tabla que apunta a padre
            $table->foreign('id_padre')->references('id_padre')->on('padre');
            // se define la llave foranea en esta tabla que apunta a usuario
            $table->foreign('id_usuario')->references('id_usuario')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_clinica');
    }
};
