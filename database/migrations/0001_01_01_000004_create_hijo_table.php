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
            $table->string('id_hijo', 10)->primary();
            
            // foranea de la tabla padre, identificador del padre
            $table->string('id_usuario', 10)->nullable(false);

            // nombres del hijo
            $table->string('nom_hijo', 70)->nullable(false);

            // apellidos del hijo
            $table->string('ape_hijo', 70)->nullable(false);

            // tipo de documento del hijo (T.I o Registro, Certificdo de nacimiento, etc)
            $table->string('tip_doc_hijo', 50)->nullable(false);

            // fecha de nacimiento del hijo, su formato es AÑO-MES-DIA (YYYY-MM-DD)
            $table->date('fech_nac_hijo')->nullable(false);

            // texto con la ruta de la imagen dentro de los archivos del servidor o dominio
            $table->text('foto_hijo')->nullable();

            // Foraneas
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
