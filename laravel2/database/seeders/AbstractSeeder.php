<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

abstract class AbstractSeeder extends Seeder
{
    protected Carbon $now;
    protected array $commonColumns;

    public function __construct()
    {
        $this->now = Carbon::now();
        $this->commonColumns = [
            'created_at' => $this->now,
            'created_by' => User::ID_SYSTEM,
            'updated_at' => $this->now,
            'updated_by' => User::ID_SYSTEM,
        ];
    }

}
