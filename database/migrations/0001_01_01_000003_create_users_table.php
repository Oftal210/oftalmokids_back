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
        Schema::create('users', function (Blueprint $table) {
            
            // identificador para el usuario (se espera el numero de la C.C.)
            // $table->id();
            $table->integer('id_usuario')->primary();

            // foranea de la tabla rol, identificador del rol
            $table->integer('cod_rol')->nullable(false);

            // nombres del usuario
            //$table->string('name');
            $table->string('name', 70)->nullable(false);

            // apellidos del usuario
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // telefono del usuario (se esperan 10 digitos sin frefijo telefonico del pais)
            $table->decimal('tele_usuario', 10,0)->nullable(false);

            // contraseña del usuario (se espera guardarla encriptada)
            //$table->string('password');
            // $table->string('cont_usuario')->nullable(false);
            
            $table->rememberToken();
            $table->timestamps();

            // se define la llave foranea en esta tabla que apunta a rol
            $table->foreign('cod_rol')->references('cod_rol')->on('rol');

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
