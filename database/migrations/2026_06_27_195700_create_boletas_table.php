<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabla "boletas" según el diagrama oficial (no existía ninguna migración para ella,
     * y "detalle_boleta" y "pagos_online" ya dependían de su llave foránea).
     */
    public function up(): void {
        if (Schema::hasTable('boletas')) {
            return;
        }

        Schema::create('boletas', function (Blueprint $table) {
            $table->id('id_boleta');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamp('fecha_venta')->useCurrent();
            $table->decimal('total_pago', 10, 2);
            $table->string('metodo_pago');
            $table->string('canal_venta')->nullable();
            $table->string('estado_pedido')->default('Pendiente');
            $table->string('tipo_comprobante')->nullable();
            $table->string('serie_comprobante')->nullable();
            $table->string('ruc_empresa', 11)->nullable();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletas');
    }
};
