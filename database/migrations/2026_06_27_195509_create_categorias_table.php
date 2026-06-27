<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria'); // RESPETA TU ID
            $table->string('nombre_categoria'); // Corregido: coincide con el diagrama y con app/Models/Categoria.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
