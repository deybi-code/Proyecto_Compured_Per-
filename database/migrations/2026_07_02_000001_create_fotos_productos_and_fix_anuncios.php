<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Esta migración resuelve dos problemas pendientes:
 *
 * 1. La tabla 'fotos_productos' es usada por el modelo FotoProducto y por
 *    AdminProductoController, pero nunca tenía su migración. Esto causaba
 *    "Table 'fotos_productos' doesn't exist" al crear productos con imágenes.
 *
 * 2. La tabla 'anuncios' no tenía la columna 'posicion', pero el controlador
 *    AdminAnuncioController intenta insertarla. Causa "Unknown column 'posicion'".
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Crear tabla fotos_productos si no existe
        if (!Schema::hasTable('fotos_productos')) {
            Schema::create('fotos_productos', function (Blueprint $table) {
                $table->id('id_foto');
                $table->unsignedBigInteger('id_producto');
                $table->string('ruta_foto');
                $table->boolean('es_principal')->default(false);
                $table->timestamps();

                $table->foreign('id_producto')
                    ->references('id_producto')
                    ->on('productos')
                    ->onDelete('cascade');
            });
        }

        // 2. Agregar columna 'posicion' a 'anuncios' si no existe
        if (Schema::hasTable('anuncios') && !Schema::hasColumn('anuncios', 'posicion')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->string('posicion')->default('principal')->after('imagen_url');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos_productos');

        if (Schema::hasColumn('anuncios', 'posicion')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn('posicion');
            });
        }
    }
};
