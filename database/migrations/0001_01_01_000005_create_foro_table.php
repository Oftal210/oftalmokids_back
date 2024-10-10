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
            
            // subtitulo que tendra el foro
            $table->text('subtitulo_foro')->nullable(false);
            
            // contenido que tendra el foro referente al titulo
            $table->text('contenido_foro')->nullable(false);
            
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