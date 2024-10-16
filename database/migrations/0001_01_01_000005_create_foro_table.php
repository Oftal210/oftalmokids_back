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
            $table->id();
            
            // subtitulo que tendra el foro
            $table->text('subtitulo_foro')->nullable(false);
            
            // contenido que tendra el foro referente al titulo
            $table->text('contenido_foro')->nullable(false);

            // Foraneas
            // se define la llave foranea en esta tabla que apunta a usuario
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            
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
