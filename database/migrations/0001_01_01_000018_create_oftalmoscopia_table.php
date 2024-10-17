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
        Schema::create('oftalmoscopia', function (Blueprint $table) {
            
            // identificador de la oftalmoscopia por historia clinica 
            $table->id();

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
        Schema::dropIfExists('oftalmoscopia');
    }
};
