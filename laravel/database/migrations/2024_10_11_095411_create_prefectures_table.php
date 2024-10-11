<?php

use Database\Migrations\CommonColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    use CommonColumns;

    /**
     * 日本語が入るカラムには下記のソート順を設定する
     */
    public const COLLATION = 'ja-x-icu';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete()->index();
            $table->string('name', 20)->unique();
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefectures');
    }
};
