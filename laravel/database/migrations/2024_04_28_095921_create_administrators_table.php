<?php

use Database\Migrations\CommonColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use CommonColumns;

    /**
     *日本語が入るカラムには下記のソート順を設定する
     */
    public const COLLATION = 'ja-x-icu';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->index();
            $table->smallInteger('status')->index();
            $table->string('name', 20)->collation(self::COLLATION)->unique();
            $table->string('email')->unique();
            $table->string('password');
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
