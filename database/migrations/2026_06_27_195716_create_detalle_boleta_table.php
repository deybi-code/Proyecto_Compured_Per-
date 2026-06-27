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
        Schema::create('detalle_boleta', function (Blueprint $table) {
            $table->id('id_detalle_boleta');
            $table->unsignedBigInteger('id_boleta');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();

            $table->foreign('id_boleta')->references('id_boleta')->on('boletas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_boleta');
    }
};
