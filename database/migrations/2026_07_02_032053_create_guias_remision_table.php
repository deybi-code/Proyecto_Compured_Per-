<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('guias_remision')) {
            return;
        }

        Schema::create('guias_remision', function (Blueprint $table) {
            $table->id('id_guia');
            $table->unsignedBigInteger('id_boleta');
            $table->string('tracking_number')->nullable();
            $table->string('empresa_courier')->nullable();
            $table->string('estado_envio')->default('Pendiente');
            $table->timestamps();

            $table->foreign('id_boleta')
                ->references('id_boleta')
                ->on('boletas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guias_remision');
    }
};
