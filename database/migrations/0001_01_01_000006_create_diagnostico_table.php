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
        Schema::create('diagnostico', function (Blueprint $table) {
            // identificador del codigo de diagnostico
            $table->string('cod_diagnostico', 10)->primary();

            // descripcion del codigo de diagnostico
            $table->text('descrip_codigo')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico');
    }
};