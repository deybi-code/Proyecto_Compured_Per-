<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * La tabla "boletas" no guardaba los datos que el cliente escribe en el
     * checkout (nombre, DNI, dirección, teléfono) — se validaban pero se
     * perdían. Sin esto, la boleta electrónica no puede mostrar "Datos del
     * cliente" como en un comprobante real.
     */
    public function up(): void
    {
        Schema::table('boletas', function (Blueprint $table) {
            // CORREGIDO: protegido con hasColumn() por el mismo motivo que las
            // demás migraciones — evita "Duplicate column name" si la columna
            // ya existe en la BD pero la migración no estaba registrada.
            if (!Schema::hasColumn('boletas', 'dni_cliente')) {
                $table->string('dni_cliente', 8)->nullable()->after('ruc_empresa');
            }
            if (!Schema::hasColumn('boletas', 'nombre_cliente')) {
                $table->string('nombre_cliente')->nullable()->after('dni_cliente');
            }
            if (!Schema::hasColumn('boletas', 'direccion_cliente')) {
                $table->string('direccion_cliente')->nullable()->after('nombre_cliente');
            }
            if (!Schema::hasColumn('boletas', 'telefono_cliente')) {
                $table->string('telefono_cliente', 20)->nullable()->after('direccion_cliente');
            }
        });
    }

    public function down(): void
    {
        Schema::table('boletas', function (Blueprint $table) {
            $table->dropColumn(['dni_cliente', 'nombre_cliente', 'direccion_cliente', 'telefono_cliente']);
        });
    }
};
