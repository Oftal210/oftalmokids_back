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
        Schema::create('preconsulta', function (Blueprint $table) {

            // identificador de la preconsulta
            $table->id();

            // si esta usando o no gafas o lentes (TRUE = SI  |  FALSE = NO)
            $table->boolean('uso_gafa_lentes')->nullable(false);

            // motivo porque no esta usando las gafas o lentes (Si el dato anterior fue FALSE o NO)
            $table->string('motivo_uso_gafas', 255)->nullable();

            // si esta usando los medicamentos (TRUE = SI  |  FALSE = NO)
            $table->boolean('uso_medicamento')->nullable(false);

            // motivo porque no esta usando los medicamentes (Si el dato anterior fue FALSE o NO)
            $table->string('motivo_uso_medicam', 255)->nullable();

            // si esta limitando el uso de pantallas (TRUE = SI  |  FALSE = NO)
            $table->boolean('limit_pantalla')->nullable(false);

            // motivo porque no esta limitando el uso de pantallas (Si el dato anterior fue FALSE o NO)
            $table->string('motiv_limit_pantalla', 255)->nullable();

            // si esta realizando actividad al aire libre (TRUE = SI  |  FALSE = NO)
            $table->boolean('activid_air_libre')->nullable(false);

            // motivo porque no esta haciendo actividad al aire libre (Si el dato anterior fue FALSE o NO)
            $table->string('motiv_acti_libre', 255)->nullable();

            // si esta teniendo una buena alimentacion (TRUE = SI  |  FALSE = NO)
            $table->boolean('buena_aliment')->nullable(false);

            // motivo porque no esta teniendo una buena alimentacion (Si el dato anterior fue FALSE o NO)
            $table->string('motiv_bue_alimen', 255)->nullable();

            // si necesita solicitar cita de control (TRUE = SI  |  FALSE = NO)
            $table->boolean('solicitar_control')->nullable(false);

            // motivo porque no esta necesita solicitar cita de control (Si el dato anterior fue FALSE o NO)
            $table->string('motiv_soli_control', 255)->nullable();

            // puntuacion en numero (de 1 a 6) sobre los datos anteriores de esta tabla
            $table->integer('puntua_preconsulta')->nullable(false);

            // fecha en la que se realiza la preconsulta por el padre o el sistema
            $table->timestamp('fecha_preconsulta')->useCurrent();

            // foranea de la tabla hijo, identificador del hijo
            $table->unsignedBigInteger('id_hijo')->nullable(false);
            // se define la llave foranea en esta tabla que apunta a hijo
            $table->foreign('id_hijo')->references('id')->on('hijo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preconsulta');
    }
};
