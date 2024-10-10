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
        Schema::create('hijo', function (Blueprint $table) {

            // identificador para el hijo (se espera el numero de la T.I)
            $table->integer('id_hijo')->primary();
            
            // foranea de la tabla padre, identificador del padre
            $table->integer('id_usuario')->nullable(false);

            // nombres del hijo
            $table->string('nom_hijo', 70)->nullable(false);

            // apellidos del hijo
            $table->string('ape_hijo', 70)->nullable(false);

            // tipo de documento del hijo (TRUE = T.I  |  FALSE = C.C)
            $table->boolean('tipdoc_hijo')->nullable(false);

            // fecha de nacimiento del hijo, su formato es AÑO-MES-DIA (YYYY-MM-DD)
            $table->date('fechnac_hijo')->nullable(false);

            // texto con la ruta de la imagen dentro de los archivos del servidor o dominio
            $table->string('foto_hijo', 255)->nullable(false);

            // se define la llave foranea en esta tabla que apunta a padre
            $table->foreign('id_usuario')->references('id_usuario')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hijo');
    }
};
