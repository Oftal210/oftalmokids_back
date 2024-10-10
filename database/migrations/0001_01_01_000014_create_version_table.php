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
        Schema::create('version', function (Blueprint $table) {
            
            // identificador de la version por historia clinica 
            $table->bigIncrements('cod_versiones')->primary();

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);
            
            // Versiones
            // observaciones para la seccion de versiones de la historia clinica
            $table->text('versi_observaci')->nullable(false);
            

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
        Schema::dropIfExists('version');
    }
};
