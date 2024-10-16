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


            $table->id();
            // se espera el numero de la T.I
            $table->string('documento');

            // nombres del hijo
            $table->string('nombre', 70)->nullable(false);

            // apellidos del hijo
            $table->string('apellido', 70)->nullable(false);

            // tipo de documento del hijo (TRUE = T.I  |  FALSE = C.C)
            $table->boolean('tipo_documento')->nullable(false);

            // fecha de nacimiento del hijo, su formato es AÑO-MES-DIA (YYYY-MM-DD)
            $table->date('fecha_nacimiento')->nullable(false);

            // texto con la ruta de la imagen dentro de los archivos del servidor o dominio
            $table->string('foto', 255)->nullable(false);

            // foranea de la tabla padre, identificador del padre
            $table->unsignedBigInteger('id_usuario');

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a padre
            $table->foreign('id_usuario')->references('id')->on('users');
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
