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
        Schema::table('products', function (Blueprint $table) {
            $table->string('unit')->default('kg')->after('sku');
            $table->decimal('weight_in_grams', 10, 2)->nullable()->after('unit');
            $table->string('origin')->nullable()->after('weight_in_grams');
            $table->boolean('is_organic')->default(false)->after('origin');
            $table->boolean('is_seasonal')->default(false)->after('is_organic');
            $table->text('storage_info')->nullable()->after('is_seasonal');
            $table->decimal('min_order', 10, 2)->default(0.5)->after('storage_info');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['unit', 'weight_in_grams', 'origin', 'is_organic', 'is_seasonal', 'storage_info', 'min_order']);
        });
    }
};
