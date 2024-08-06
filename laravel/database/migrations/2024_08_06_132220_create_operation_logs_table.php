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
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('operated_at');
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->index();
            $table->smallInteger('operation_type');
            $table->text('name');
            $table->text('value')->nullable();
            $table->text('namespace')->nullable();
            $table->text('class_name')->nullable();
            $table->string('api_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_logs');
    }
};
