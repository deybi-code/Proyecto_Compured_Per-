<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * La migración anterior (2026_07_02_000001) solo agrega la columna 'posicion'
 * si no existía. En producción esa columna ya existía con un tipo antiguo
 * (probablemente ENUM con una lista de valores distinta a
 * 'principal' | 'secundario' | 'lateral'), así que nunca se corrigió.
 *
 * Esto causaba: SQLSTATE[01000]: Data truncated for column 'posicion'
 * al insertar 'principal', porque MySQL en modo estricto rechaza valores
 * que no están en la lista del ENUM.
 *
 * Usamos SQL directo (ALTER TABLE ... MODIFY) en vez de Schema::change()
 * porque este proyecto no tiene instalado doctrine/dbal.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('anuncios') && Schema::hasColumn('anuncios', 'posicion')) {
            DB::statement("ALTER TABLE anuncios MODIFY posicion VARCHAR(20) NOT NULL DEFAULT 'principal'");
        }
    }

    public function down(): void
    {
        // No hay una forma segura de revertir a un ENUM desconocido; no-op.
    }
};
