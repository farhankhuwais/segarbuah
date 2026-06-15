<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('is_organic');
            $table->index('is_seasonal');
            $table->index(['category_id', 'is_active']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('status');
            $table->index('payment_status');
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->index('product_id');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['is_organic']);
            $table->dropIndex(['is_seasonal']);
            $table->dropIndex(['category_id', 'is_active']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
            $table->dropIndex(['user_id']);
        });
    }
};
