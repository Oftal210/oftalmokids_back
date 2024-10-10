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
            $table->bigIncrements('cod_diag_his')->primary();

            // foranea de la tabla diagnostico, idenficador del diagnostico que tiene este registro
            $table->string('cod_diagnostico', 150)->nullable(false);

            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('cod_historia')->nullable(false);

            // Anamnesis ↓ 
            // motivo de la consulta
            $table->text('motivo_consulta')->nullable(false);

            // Datos finales 
            // resultado del tratamiento
            $table->text('tratam_diag_his')->nullable(false);

            // resultado del pronostico
            $table->text('pronos_diag_his')->nullable(false); 

            // resultado de los controles o fechas
            $table->text('control_diag_his')->nullable(false); 

            // fecha y hora en la cual se realizo 
            $table->timestamp('hora_fecha_diag')->default(DB::raw('CURRENT_TIMESTAMP'));

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('cod_diagnostico')->references('cod_diagnostico')->on('diagnostico');

            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('cod_historia')->references('cod_historia')->on('historia_clinica');
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
