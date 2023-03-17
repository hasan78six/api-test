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
        Schema::create('merchant_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id', false);
            $table->string('token', 100)->unique();
            $table->string('company_name', 50)->unique();
            $table->timestamps();
            $table->foreign('merchant_id')->references('id')->on('users');
            $table->unique(['merchant_id', 'token', 'company_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_detail');
    }
};
