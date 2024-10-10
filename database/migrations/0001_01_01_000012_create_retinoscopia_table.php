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
        Schema::create('retinoscopia', function (Blueprint $table) {
            
            // identificador del antecedente visual por historia clinica 
            $table->bigIncrements('cod_retinoscopia')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

            // Retinoscopia
            // tecnica usada para la retinoscopia
            $table->string('retino_tecnica', 150)->nullable(false);

            // resultado cicloplegico de la retinoscopia
            $table->string('retino_ciclople', 150)->nullable(false);

            // resultado de la refraccion para el ojo derecho
            $table->string('retino_refrac_od', 150)->nullable(false);

            // resultado del subjetivo para el ojo derecho
            $table->string('retino_subjet_od', 150)->nullable(false);

            // resultado del final para el ojo derecho
            $table->string('retino_final_od', 150)->nullable(false);

            // resultado de la refraccion para el ojo izquierdo
            $table->string('retino_refrac_os', 150)->nullable(false);

            // resultado del subjetivo para el ojo izquierdo
            $table->string('retino_subjet_os', 150)->nullable(false);
    
            // resultado del final para el ojo izquierdo
            $table->string('retino_final_os', 150)->nullable(false);

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
        Schema::dropIfExists('retinoscopia');
    }
};
