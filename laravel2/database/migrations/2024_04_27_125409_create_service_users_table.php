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
        Schema::create('service_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete()->index();
            $table->smallInteger('status')->index();
            $table->string('handle_name', 20)->unique()->nullable();
            $table->string('display_name', 20)->collation(self::COLLATION)->index()->nullable();
            $table->string('email')->unique()->index();
            $table->foreignId('avatar_id')->nullable()->constrained('upload_files')->cascadeOnUpdate()->nullOnDelete();
            $table->string('onetime_token')->index()->nullable();
            $table->timestamp('onetime_expiration')->nullable();
            $table->timestamp('registered_at')->nullable();
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_users');
    }
};
