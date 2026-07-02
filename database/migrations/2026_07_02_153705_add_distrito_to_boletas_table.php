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
        Schema::table('boletas', function (Blueprint $table) {
            if (! Schema::hasColumn('boletas', 'distrito')) {
                $table->string('distrito')->nullable()->after('telefono_cliente');
            }
            if (! Schema::hasColumn('boletas', 'costo_delivery')) {
                $table->decimal('costo_delivery', 8, 2)->default(0)->after('distrito');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boletas', function (Blueprint $table) {
            if (Schema::hasColumn('boletas', 'distrito')) {
                $table->dropColumn('distrito');
            }
            if (Schema::hasColumn('boletas', 'costo_delivery')) {
                $table->dropColumn('costo_delivery');
            }
        });
    }
};
