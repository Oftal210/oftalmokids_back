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
        Schema::create('antecedente_visual', function (Blueprint $table) {

            // identificador del antecedente visual por historia clinica 
            $table->bigIncrements('cod_antece_visua')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

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

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('cod_historia')->references('cod_historia')->on('historia_clinica');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedente_visual');
    }
};
