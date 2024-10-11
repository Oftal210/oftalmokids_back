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
        Schema::create('motalidad_ocular', function (Blueprint $table) {

            // identificador de la motalidad ocular por historia clinica 
            $table->id();

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

            // Foraneas
            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('id_historia')->nullable(false);
            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('id_historia')->references('id')->on('historia_clinica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motalidad_ocular');
    }
};
