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
        Schema::create('historial_modificaciones', function (Blueprint $table) {
            $table->id('id_historial');
            $table->integer('id_muestra')->nullable();
            $table->string('certificado', 100)->nullable();
            $table->integer('id_parametro')->nullable();
            $table->string('nombre_parametro', 255)->nullable();
            $table->string('valor_anterior', 50)->nullable();
            $table->string('valor_nuevo', 50)->nullable();
            $table->string('usuario', 150)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_modificaciones');
    }
};
