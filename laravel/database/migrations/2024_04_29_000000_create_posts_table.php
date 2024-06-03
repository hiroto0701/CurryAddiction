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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete()->index();
            $table->unsignedBigInteger('post_img_id')->nullable()->index();
            $table->foreign('post_img_id')->references('id')->on('upload_files')->cascadeOnUpdate()->cascadeOnDelete();
            $table->smallInteger('region_id')->index();
            $table->smallInteger('prefecture_id')->index();
            $table->smallInteger('genre_id')->index();
            $table->string('store_name', 30)->index();
            $table->text('comment')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamp('posted_at');
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
