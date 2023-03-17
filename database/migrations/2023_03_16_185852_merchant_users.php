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
        Schema::create('merchant_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id', false);
            $table->unsignedBigInteger('user_id', false);
            $table->timestamps();
            $table->foreign('merchant_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['user_id', 'merchant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_users');
    }
};
