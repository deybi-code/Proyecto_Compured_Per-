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
    Schema::create('pagos_online', function (Blueprint $table) {
        $table->id('id_pago');
        $table->unsignedBigInteger('id_boleta');
        $table->decimal('monto', 10, 2);
        $table->string('metodo_pago');
        $table->string('estado'); // 'aprobado', 'pendiente'
        $table->timestamps();

        $table->foreign('id_boleta')->references('id_boleta')->on('boletas');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_online');
    }
};
