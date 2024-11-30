<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\App;
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
            App::environment('local')
                ? \Database\Seeders\Dev\AccountSeeder::class
                : \Database\Seeders\Production\AccountSeeder::class,
            \Database\Seeders\Common\MailTemplateSeeder::class,
            \Database\Seeders\Common\CurryGenreSeeder::class,
            \Database\Seeders\Common\RegionSeeder::class,
            \Database\Seeders\Common\PrefectureSeeder::class,
        ]);

    }
}
