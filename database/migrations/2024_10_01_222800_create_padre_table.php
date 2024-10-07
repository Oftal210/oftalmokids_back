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
        Schema::create('padre', function (Blueprint $table) {
    
            // identificador para el padre (se espera el numero de la C.C.)
            $table->integer('id_padre')->primary();

            // foranea de la tabla rol, identificador del rol
            $table->integer('cod_rol')->nullable(false);

            // nombres del padre
            $table->string('nom_padre', 70)->nullable(false);
            
            // apellidos del padre
            $table->string('ape_padre', 70)->nullable(false);
            
            // telefono del padre (se esperan 10 digitos sin frefijo telefonico del pais)
            $table->decimal('tele_padre', 10, 0)->nullable(false);
            
            // email del usuario (su limite de caracteres es el standar de los correos electronicos)
            $table->string('email_padre', 255)->nullable(false);
            
            // contraseña del usuario (se espera guardarla encriptada)
            $table->string('cont_padre', 255)->nullable(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padre');
    }
};
