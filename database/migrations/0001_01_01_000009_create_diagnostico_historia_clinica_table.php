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
        Schema::create('diagnostico_historia_clinica', function (Blueprint $table) {

            // identificador del diagnostico por historia clinica 
            $table->id();

            // Anamnesis ↓ 
            // motivo de la consulta
            $table->text('motivo_consulta')->nullable(false);

            // Datos finales 
            // resultado del tratamiento
            $table->text('tratamiento')->nullable(false);

            // resultado del pronostico
            $table->text('pronostico')->nullable(false);

            // resultado de los controles o fechas
            $table->text('control')->nullable(false);

            // fecha y hora en la cual se realizo 
            $table->timestamp('fecha')->useCurrent();

            // Foraneas
            // foranea de la tabla diagnostico, idenficador del diagnostico que tiene este registro
            $table->unsignedBigInteger('id_diagnostico')->nullable(false);
            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('id_diagnostico')->references('id')->on('diagnostico');
            
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
        Schema::dropIfExists('diagnostico_historia_clinica');
    }
};
