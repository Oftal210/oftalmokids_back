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
        Schema::create('duccion', function (Blueprint $table) {
            
            // identificador de las ducciones por historia clinica 
            $table->bigIncrements('cod_ducciones')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

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
        Schema::dropIfExists('duccion');
    }
};
