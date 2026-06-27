<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->string('marca');
            $table->text('detalles_tecnicos')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('mostrar_inicio')->default(false);

            // Relación (asumimos que existe tabla categorias)
            // $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
