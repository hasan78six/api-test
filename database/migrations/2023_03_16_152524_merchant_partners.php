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
        Schema::create('merchant_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id', false);
            $table->unsignedBigInteger('partner_id', false);
            $table->unsignedTinyInteger('status', false);
            $table->string('settings');
            $table->timestamps();
            $table->foreign('merchant_id')->references('id')->on('users');
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->foreign('status')->references('id')->on('status');
            $table->unique(['merchant_id', 'partner_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_partners');
    }
};
