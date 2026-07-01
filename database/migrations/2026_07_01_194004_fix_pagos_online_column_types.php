<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Igual que con "boletas.canal_venta": en producción "pagos_online.estado_pago"
     * quedó como ENUM con una lista de valores vieja que no incluye "aprobado",
     * causando: SQLSTATE[01000]: Data truncated for column 'estado_pago'.
     *
     * Se fuerza a VARCHAR libre. De paso se hace lo mismo con "metodo_pago"
     * de esta misma tabla, por si tenía el mismo problema oculto.
     */
    public function up(): void
    {
        Schema::table('pagos_online', function (Blueprint $table) {
            $table->string('estado_pago', 50)->change();
            $table->string('metodo_pago', 50)->change();
        });
    }

    public function down(): void
    {
        // No revertimos a ENUM: no conocemos la lista original de valores.
    }
};
