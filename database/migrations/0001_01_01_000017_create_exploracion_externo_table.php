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
        Schema::create('exploracion_externo', function (Blueprint $table) {
            
            // identificador de las exploraciones externas por historia clinica 
            $table->bigIncrements('cod_explo_exter')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

            // Exploracion de externos
            // resultado de exploracion de externos para el ojo derecho
            $table->string('explo_exter_od', 150)->nullable(false);
            
            // resultado de exploracion de externos para el ojo izquierdo
            $table->string('explo_exter_os', 150)->nullable(false);


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
        Schema::dropIfExists('exploracion_externo');
    }
};
