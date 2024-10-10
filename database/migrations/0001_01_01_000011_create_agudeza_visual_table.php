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
        Schema::create('agudeza_visual', function (Blueprint $table) {

            // identificador de la agudeza visual por historia clinica 
            $table->bigIncrements('cod_agude_visua')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

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
        Schema::dropIfExists('agudeza_visual');
    }
};
