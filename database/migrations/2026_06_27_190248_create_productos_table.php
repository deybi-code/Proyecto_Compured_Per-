<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CORREGIDO: mismo problema que en las migraciones anteriores — protegido
        // con hasTable() para que no falle si la tabla ya existe físicamente en la
        // BD pero no está registrada en la tabla `migrations`.
        if (Schema::hasTable('productos')) {
            return;
        }

        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('marca');
            $table->text('detalles_tecnicos')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->string('imagen')->nullable(); // AÑADIDO: campo para la imagen del producto
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('mostrar_inicio')->default(false);
        });

        // CORREGIDO: la FK a `categorias` se agrega en un paso aparte, después de
        // crear la tabla, y solo si `categorias` ya existe. Esta migración
        // (2026_06_27_190248) corre ANTES que create_categorias_table
        // (2026_06_27_195509) por orden de fecha, así que declarar la FK dentro
        // del mismo Schema::create rompería una instalación 100% nueva con
        // "Cannot add foreign key constraint" porque `categorias` todavía no
        // existiría en ese momento.
        if (Schema::hasTable('categorias')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
