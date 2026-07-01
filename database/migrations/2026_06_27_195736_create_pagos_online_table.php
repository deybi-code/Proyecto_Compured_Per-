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
        if (Schema::hasTable('pagos_online')) {
            return;
        }

        Schema::create('pagos_online', function (Blueprint $table) {
            $table->id('id_pago');
            $table->unsignedBigInteger('id_boleta');
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago');
            $table->string('estado'); // 'aprobado', 'pendiente', 'rechazado'
            $table->timestamps();

            $table->foreign('id_boleta')->references('id_boleta')->on('boletas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos_online');
    }
};
