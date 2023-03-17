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
        Schema::create('merchant_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id', false);
            $table->unsignedBigInteger('product_id', false);
            $table->unsignedDecimal('price', 5, 2);
            $table->unsignedTinyInteger('status', false);
            $table->timestamps();
            $table->foreign('status')->references('id')->on('status');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('merchant_id')->references('id')->on('users');
            $table->unique(['merchant_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_products');
    }
};
