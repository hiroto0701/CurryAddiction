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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('official_name');
            $table->string('postcode');
            $table->text('formatted_address');
            $table->string('prefecture')->index();
            $table->string('municipality')->index();
            $table->string('ward')->nullable()->index();
            $table->string('district')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('official_name');
            $table->dropColumn('postcode');
            $table->dropColumn('formatted_address');
            $table->dropColumn('prefecture');
            $table->dropColumn('municipality');
            $table->dropColumn('ward');
            $table->dropColumn('district');
        });
    }
};
