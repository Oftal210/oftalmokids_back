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
        Schema::create('foro_like', function (Blueprint $table) {

            // identificador principal
            $table->id();
            // guardamos fechas de insercion de likes y si se quitan
            $table->timestamps();

            // guardamos el usuario que dio like
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade'); // Relación con usuarios
            
            // guardamos el foro al que se le dio like
            $table->unsignedBigInteger('id_foro');
            $table->foreign('id_foro')->references('id')->on('foro')->onDelete('cascade'); // Relación con foros

            // validamos que solo haya un registro de foro y usuario igual
            $table->unique(['id_usuario', 'id_foro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foro_like');
    }
};
