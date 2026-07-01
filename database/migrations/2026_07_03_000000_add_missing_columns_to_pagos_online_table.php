<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CORREGIDO: PagoController::confirmarTarjeta() inserta en 'pagos_online' las
 * columnas 'estado_pago', 'transaccion_id' y 'fecha_pago', pero la migración
 * original (create_pagos_online_table) solo tenía 'estado' y no tenía
 * 'transaccion_id' ni 'fecha_pago'. Además 'monto' es obligatoria (sin
 * default) y el controlador no la enviaba. Resultado: el pago con tarjeta
 * fallaba siempre con "Unknown column" / "Field 'monto' doesn't have a
 * default value".
 *
 * Esta migración agrega/renombra solo lo que falta, sin tocar filas
 * existentes.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pagos_online')) {
            return;
        }

        Schema::table('pagos_online', function (Blueprint $table) {
            if (!Schema::hasColumn('pagos_online', 'estado_pago')) {
                if (Schema::hasColumn('pagos_online', 'estado')) {
                    $table->renameColumn('estado', 'estado_pago');
                } else {
                    $table->string('estado_pago', 50)->default('pendiente');
                }
            }

            if (!Schema::hasColumn('pagos_online', 'transaccion_id')) {
                $table->string('transaccion_id')->nullable()->after('metodo_pago');
            }

            if (!Schema::hasColumn('pagos_online', 'fecha_pago')) {
                $table->timestamp('fecha_pago')->nullable();
            }

            if (!Schema::hasColumn('pagos_online', 'monto')) {
                $table->decimal('monto', 10, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('pagos_online', function (Blueprint $table) {
            if (Schema::hasColumn('pagos_online', 'transaccion_id')) {
                $table->dropColumn('transaccion_id');
            }
            if (Schema::hasColumn('pagos_online', 'fecha_pago')) {
                $table->dropColumn('fecha_pago');
            }
        });
    }
};
