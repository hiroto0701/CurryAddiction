<?php

declare(strict_types=1);

namespace Database\Migrations;

use Illuminate\Database\Schema\Blueprint;

trait CommonColumns
{
    public function addCommonColumns(Blueprint $table)
    {
        $table->timestamp('created_at', 0)->nullable();
        $table->foreignId('created_by')->nullable();
        $table->timestamp('updated_at', 0)->nullable();
        $table->foreignId('updated_by')->nullable();
        $table->timestamp('deleted_at', 0)->nullable();
        $table->foreignId('deleted_by')->nullable();
    }
}
