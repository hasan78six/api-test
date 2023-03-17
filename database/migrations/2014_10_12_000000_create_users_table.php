<?php

use App\Models\User;
use App\Models\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->unsignedTinyInteger('user_type', false)->default(UserType::USER);
            $table->unsignedTinyInteger('status', false)->default(User::STATUS_ACTIVE);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();
            $table->foreign('status')->references('id')->on('status');
            $table->foreign('user_type')->references('id')->on('user_types');
            $table->unique(['email', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
