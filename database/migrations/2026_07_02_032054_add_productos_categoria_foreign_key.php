<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('productos') || ! Schema::hasTable('categorias')) {
            return;
        }

        try {
            Schema::table('productos', function (Blueprint $table) {
                $table->foreign('id_categoria')
                    ->references('id_categoria')
                    ->on('categorias')
                    ->nullOnDelete();
            });
        } catch (Throwable) {
            // La FK ya existe en instalaciones previas.
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('productos')) {
            return;
        }

        try {
            Schema::table('productos', function (Blueprint $table) {
                $table->dropForeign(['id_categoria']);
            });
        } catch (Throwable) {
            //
        }
    }
};
