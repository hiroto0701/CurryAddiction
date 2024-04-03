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
        Schema::dropIfExists('service_users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('service_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('handle_name', 20)->unique();
            $table->string('display_name', 20);
            $table->string('email')->unique();
            $table->string('password');
            $table->text('profile_path');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
};
