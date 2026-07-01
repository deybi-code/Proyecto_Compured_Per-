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
        // CORREGIDO: en una instalación nueva la columna todavía se llama
        // 'estado' (o no existe como ENUM), así que forzar el ->change() aquí
        // rompía el deploy con "Unknown column". Se protege para que solo
        // actúe si la columna ya existe con ese nombre.
        Schema::table('pagos_online', function (Blueprint $table) {
            if (Schema::hasColumn('pagos_online', 'estado_pago')) {
                $table->string('estado_pago', 50)->change();
            }
            if (Schema::hasColumn('pagos_online', 'metodo_pago')) {
                $table->string('metodo_pago', 50)->change();
            }
        });
    }

    public function down(): void
    {
        // No revertimos a ENUM: no conocemos la lista original de valores.
    }
};
