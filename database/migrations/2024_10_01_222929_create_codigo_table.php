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
        Schema::create('codigo', function (Blueprint $table) {

            // identificador del codigo
            $table->bigIncrements('cod_codigo')->primary();

            // nombre del codigo
            $table->string('nom_codigo', 50)->nullable(false);

            // descripcion del codigo
            $table->text('descrip_codigo')->nullable(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo');
    }
};
