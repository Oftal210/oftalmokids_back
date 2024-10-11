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
        Schema::create('historia_clinica', function (Blueprint $table) {

            // Identificador de la historia clínica
            $table->id();
        
            // Antecedentes médico-personales ↓
            $table->integer('edad_embarazo')->nullable(false);
            $table->boolean('alto_riesgo')->nullable(false);
            $table->text('especificar_riesgo')->nullable();
            $table->integer('semanas_gestacion')->nullable(false);
            $table->string('tipo_parto', 50)->nullable(false);
            $table->boolean('complicacion')->nullable(false);
            $table->text('especificar_compli')->nullable();
            $table->boolean('uso_incubadora')->nullable(false);
            $table->text('tiempo_incubadora')->nullable();
            $table->integer('apgar_incubadora')->nullable(false);
            $table->boolean('respiro_lloro_nacer')->nullable(false);
            $table->boolean('enfermedades_embarazo')->nullable(false);
            $table->text('especificar_enfermedades')->nullable();
            $table->boolean('medicamento_embarazo')->nullable(false);
            $table->text('especificar_medicamento')->nullable();
            $table->boolean('enfermedad_sistemica')->nullable(false);
            $table->text('especif_enferm_sistemica')->nullable();
            $table->boolean('alergia')->nullable(false);
            $table->text('especificar_alergia')->nullable();
            $table->boolean('cirugia_ocular')->nullable(false);

            // Datos que refieren al padre
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        
            // Clave foránea que apunta a `hijo`
            $table->unsignedBigInteger('id_hijo');
            $table->foreign('id_hijo')->references('id')->on('hijo')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_clinica');
    }
};
