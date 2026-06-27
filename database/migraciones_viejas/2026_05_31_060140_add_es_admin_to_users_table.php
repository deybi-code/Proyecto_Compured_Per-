<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * FIX CRÍTICO #2: La migración original apuntaba a la tabla 'users' que no existe.
 * La tabla real se llama 'usuarios' y ya tiene la columna 'rol' para manejar
 * administradores. Esta migración ya NO es necesaria pero se mantiene como
 * no-op para no romper el historial de migraciones.
 */
return new class extends Migration
{
    public function up(): void
    {
        // No-op: El rol de administrador ya está manejado por la columna 'rol'
        // en la tabla 'usuarios'. No se necesita columna 'es_admin' adicional.
        // La migración original fallaba porque apuntaba a 'users' (tabla inexistente).
    }

    public function down(): void
    {
        // No-op
    }
};
