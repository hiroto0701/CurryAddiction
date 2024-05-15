<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * ２段階認証用トークンテーブル
         * ２段階認証用トークンを一時保存するテーブル
         */
        Schema::create('two_step_authentications', function (Blueprint $table) {
            // テーブルの作成 複合インデックス
            $table->foreignId('user_id');
            $table->string('token');
            $table->timestamp('expire_datetime');
            $table->index(['user_id', 'token']);
        });

        /**
         * システム管理者テーブル
         * システム管理者アカウントの情報を管理するテーブル
         */
        Schema::table('administrators', function (Blueprint $table) {
            // カラム追加
            $table->boolean('use_two_step_authentication')->default(true);
        });

        /**
         * サービス利用者テーブル
         */
        Schema::table('service_users', function (Blueprint $table) {
            // カラム追加
            $table->boolean('use_two_step_authentication')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * ２段階認証用トークンテーブル
         * ２段階認証用トークンを一時保存するテーブル
         */
        // テーブル削除
        Schema::dropIfExists('two_step_authentications');

        /**
         * システム管理者テーブル
         * システム管理者アカウントの情報を管理するテーブル
         */
        Schema::table('administrators', function (Blueprint $table) {
            // カラムの削除
            $table->dropColumn('use_two_step_authentication');
        });

        /**
         * サービス利用者テーブル
         */
        Schema::table('service_users', function (Blueprint $table) {
            // カラムの削除
            $table->dropColumn('use_two_step_authentication');
        });
    }
};
