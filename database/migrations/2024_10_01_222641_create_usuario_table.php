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
        Schema::create('usuario', function (Blueprint $table) {
            
            // identificador para el usuario (se espera el numero de la C.C.)
            $table->integer('id_usuario')->primary();

            // foranea de la tabla rol, identificador del rol
            $table->integer('cod_rol')->nullable(false);

            // nombres del usuario
            $table->string('nom_usuario', 70)->nullable(false);

            // apellidos del usuario
            $table->string('ape_usuario', 70)->nullable(false);
            
            // email del usuario (su limite de caracteres es el standar de los correos electronicos)
            $table->string('email_usuario', 255)->nullable(false);

            // telefono del usuario (se esperan 10 digitos sin frefijo telefonico del pais)
            $table->decimal('tele_usuario', 10,0)->nullable(false);
            
            // contraseña del usuario (se espera guardarla encriptada)
            $table->string('cont_usuario', 255)->nullable(false);
            
            // se define la llave foranea en esta tabla que apunta a rol
            $table->foreign('cod_rol')->references('cod_rol')->on('rol');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
