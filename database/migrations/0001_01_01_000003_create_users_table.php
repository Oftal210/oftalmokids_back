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

            $table->id();
            // Identificador para el usuario (se espera el numero de la C.C.)
            $table->string('documento')->nullable(value: false);

            // Contraseña del usuario
            $table->string('contrasena', 255)->nullable(false);

            // Nombres del usuario
            $table->string('nombre', 50)->nullable(false);

            // Apellidos del usuario
            $table->string('apellido', 50)->nullable(false);

            // Email del usuario
            $table->string('email', 50)->unique(true);

            // telefono del usuario 
            $table->string('telefono',13)->nullable(false);
        

            // Foranea de la tabla rol, identificador del rol
            $table->unsignedBigInteger('id_rol')->nullable(false);
            // se define la llave foranea en esta tabla que apunta a rol
            $table->foreign('id')->references('id_rol')->on('rol');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            //$table->timestamps();
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
