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
        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('inventory_id')->references('id')->on('product_inventory');
            $table->foreign('discount_id')->references('id')->on('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['inventory_id']);
            $table->dropForeign(['discount_id']);
        });
    }
};
