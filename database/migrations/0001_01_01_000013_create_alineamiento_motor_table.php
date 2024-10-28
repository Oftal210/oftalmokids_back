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
        Schema::create('alineamiento_motor', function (Blueprint $table) {
            
            // identificador del alineamiento motor por historia clinica 
            $table->id();

            // Alineamiento motor
            // resultado del test de hirschberg
            $table->string('test_hirschberg', 150)->nullable(false);

            // resultado del test de bruckner
            $table->string('test_bruckner', 150)->nullable(false);

            // resultado del covet test para vl (vision lejana)
            $table->string('covet_test_vl', 150)->nullable(false);

            // resultado del covet test para vp (vision proxima)
            $table->string('covet_test_vp', 150)->nullable(false);

            // resultado del estado acomodativo para flex
            $table->string('esta_acomo_flex', 150)->nullable(false);

            // resultado del estado acomodativo para aa
            $table->string('esta_acomo_aa', 150)->nullable(false);

            // fechas de creacion y actualizacion
            $table->timestamps();

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
        Schema::dropIfExists('alineamiento_motor');
    }
};
