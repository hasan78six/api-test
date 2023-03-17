<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_product_id', false);
            $table->unsignedBigInteger('user_id', false);
            $table->unsignedBigInteger('merchant_partner', false);
            $table->unsignedTinyInteger('status', false);
            $table->string('transaction_id', 100);
            $table->timestamps();
            $table->foreign('status')->references('id')->on('status');
            $table->foreign('merchant_product_id')->references('id')->on('merchant_products');
            $table->foreign('merchant_partner')->references('id')->on('merchant_partners');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['user_id', 'merchant_product_id', 'merchant_partner', 'transaction_id'], 'uq_subscription');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
