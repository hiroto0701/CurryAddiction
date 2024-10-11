<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // データ削除
        // \App\Models\User::truncate();
        // \App\Models\ServiceUser::truncate();
        // \App\Models\Genre::truncate();

        $this->call([
            \Database\Seeders\Dev\AccountSeeder::class,
            \Database\Seeders\Dev\MailTemplateSeeder::class,
            \Database\Seeders\Dev\CurryGenreSeeder::class,
            \Database\Seeders\Dev\RegionSeeder::class,
            \Database\Seeders\Dev\PrefectureSeeder::class,
        ]);
    }
}
