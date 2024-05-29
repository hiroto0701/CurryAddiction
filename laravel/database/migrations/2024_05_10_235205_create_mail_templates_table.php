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
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('type')->index();
            $table->string('subject')->collation(self::COLLATION);
            $table->text('body')->collation(self::COLLATION);
            // 共通カラム
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mail_templates');
    }
};
