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
        Schema::create('version', function (Blueprint $table) {
            
            // identificador de la version por historia clinica 
            $table->id();
            
            // Versiones
            // observaciones para la seccion de versiones de la historia clinica
            $table->text('observacion')->nullable(false);

            // datos de versiones RSD OII (SUPERIOR IZQUIERDO)
            $table->string('rsd_oii')->nullable();

            // datos de versiones RLD RMI (MEDIO IZQUIERDO)
            $table->string('rld_rmi')->nullable();

            // datos de versiones RID OSI (INFERIRO IZQUIERDO)
            $table->string('rid_osi')->nullable();

            // datos de versiones OID RSI (SUPERIOR DERECHO)
            $table->string('oid_rsi')->nullable();

            // datos de versiones RMD RLI (MEDIO DERECHO)
            $table->string('rmd_rli')->nullable();

            // datos de versiones OSD RII (INFERIOR DERECHO)
            $table->string('osd_rii')->nullable();

            // fechas de creacion y actualizacion
            $table->timestamps();
            
            // Foraneas
            // foranea de la tabla historia_clinica, idenficador de la historia clinica a la que se enlaza
            $table->unsignedBigInteger('id_historia')->nullable(false);
            // se define la llave foranea en esta tabla que apunta a historia clinica
            $table->foreign('id_historia')->references('id')->on('historia_clinica')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version');
    }
};
