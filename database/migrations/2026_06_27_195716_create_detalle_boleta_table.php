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
    Schema::create('detalle_boleta', function (Blueprint $table) {
        $table->id('id_detalle_boleta');
        $table->unsignedBigInteger('id_boleta');
        $table->unsignedBigInteger('id_producto');
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);
        $table->timestamps();

        // Relaciones (Opcional, pero recomendado por el profe)
        $table->foreign('id_boleta')->references('id_boleta')->on('boletas');
        $table->foreign('id_producto')->references('id_producto')->on('productos');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_boleta');
    }
};
