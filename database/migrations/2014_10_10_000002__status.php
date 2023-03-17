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
        Schema::create('status', function (Blueprint $table) {
            $table->tinyIncrements("id");
            $table->unsignedTinyInteger('type_id', false);
            $table->string('status', 50);
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('status_types');
            $table->unique(['type_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
