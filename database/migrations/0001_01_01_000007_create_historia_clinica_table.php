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

            // nombre del padre al que pertenece el hijo
            $table->string('nom_padre', 70)->nullable(false);

            // apellido del padre al que pertenece el hijo
            $table->string('ape_padre', 70)->nullable(false);

            // direccion del padre al que pertenece el hijo
            $table->string('direccion_padre', 255)->nullable(false);

            // telefono del padre al que pertenece el hijo
            $table->string('telefono_padre', 255)->nullable(false);

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
            $table->text('tipo_parto')->nullable(false);

            // si hubo o no complicaciones (TRUE = SI  |  FALSE = NO)               
            $table->boolean('complicacion')->nullable(false);

            // especifique porque hubieron complicaciones en el embarazo (Si el dato anterior fue TRUE o SI)           
            $table->text('especif_compli')->nullable();

            // si uso o no incubadora (TRUE = SI  |  FALSE = NO)                       
            $table->boolean('uso_incubadora')->nullable(false);

            // cuanto tiempo uso la incubadora (Si el dato anterior fue TRUE o SI)           
            $table->text('tiempo_incubadora')->nullable();

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
            $table->boolean('cirug_gener_ocular')->nullable(false);            

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a hijo
            $table->foreign('id_hijo')->references('id_hijo')->on('hijo');

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
