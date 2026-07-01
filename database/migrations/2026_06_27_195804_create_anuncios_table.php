<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CORREGIDO: la indentación del método up() estaba rota (el cierre de Schema::create
    // quedaba fuera del método), lo que causaría un error de sintaxis.
    public function up(): void
    {
        if (Schema::hasTable('anuncios')) {
            return;
        }

        Schema::create('anuncios', function (Blueprint $table) {
            $table->id('id_anuncio');
            $table->string('titulo');
            $table->string('imagen_url'); // Nombre exacto de la columna (consistente con el controlador)
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
