<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('tipo_garantia')->nullable()->after('porcentaje_descuento')->comment('fabricante, tienda, extendida');
            $table->integer('meses_garantia')->nullable()->after('tipo_garantia')->comment('Duración en meses');
            $table->text('condiciones_garantia')->nullable()->after('meses_garantia')->comment('Condiciones específicas de la garantía');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['tipo_garantia', 'meses_garantia', 'condiciones_garantia']);
        });
    }
};
