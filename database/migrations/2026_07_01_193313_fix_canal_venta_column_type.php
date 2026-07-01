<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * En producción la columna "canal_venta" (y posiblemente otras similares)
     * quedó creada como ENUM con una lista fija de valores antiguos, distinta
     * a lo que el código realmente envía hoy (p. ej. "Recojo en Tienda").
     * Esto provocaba: SQLSTATE[01000]: Data truncated for column 'canal_venta'.
     *
     * Esta migración fuerza esas columnas a VARCHAR libre para que acepten
     * cualquier texto que el controlador les mande.
     */
    public function up(): void
    {
        Schema::table('boletas', function (Blueprint $table) {
            $table->string('canal_venta', 50)->nullable()->change();
            $table->string('metodo_pago', 50)->change();
            $table->string('estado_pedido', 50)->default('Pendiente')->change();
            $table->string('tipo_comprobante', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        // No revertimos a ENUM: no sabemos cuál era la lista original de valores
        // y volver a un ENUM estricto podría romper datos ya guardados.
    }
};
