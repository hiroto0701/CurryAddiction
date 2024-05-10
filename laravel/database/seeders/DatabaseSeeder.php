<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     UserSeeder::class,
        //     ServiceUserSeeder::class,
        // ]);

        // データ削除
        // \App\Models\User::truncate();
        // \App\Models\ServiceUser::truncate();

        $this->call([
            \Database\Seeders\Dev\AccountSeeder::class,
        ]);
    }
}
