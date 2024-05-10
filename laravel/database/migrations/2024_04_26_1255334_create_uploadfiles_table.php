<?php

use Database\Migrations\CommonColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use CommonColumns;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uploadfiles', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('type')->index();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->index();
            $table->string('uuid')->unique();
            $table->string('path');
            $table->string('content_type');
            $table->timestamp('uploaded_at');
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploadfiles');
    }
};
