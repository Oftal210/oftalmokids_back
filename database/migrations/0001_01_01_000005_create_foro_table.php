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
        Schema::create('foro', function (Blueprint $table) {

            // identificador de la preconsulta
            $table->bigIncrements('cod_foro')->primary();

            // Foranea de la tabla usuario, identificador del usuario (padre)
            $table->string('id_usuario', 10)->nullable(false);
            
            // subtitulo que tendra el foro
            $table->text('subtitulo_foro')->nullable(false);
            
            // contenido que tendra el foro referente al titulo
            $table->text('contenido_foro')->nullable(false);

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a usuario
            $table->foreign('id_usuario')->references('id_usuario')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foro');
    }
};
