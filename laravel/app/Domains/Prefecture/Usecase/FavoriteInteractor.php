<?php

declare(strict_types=1);

namespace App\Domains\Prefecture\Usecase;

use App\Models\UserFavoritePrefecture;
use Illuminate\Support\Facades\DB;

class FavoriteInteractor
{
    /**
     * @param int $userId
     * @param array $prefectureIds
     * @return void
     */
    public function handle(int $userId, array $prefectureIds): void
    {
        DB::transaction(function () use ($userId, $prefectureIds) {
            UserFavoritePrefecture::where('user_id', $userId)->delete();

            foreach ($prefectureIds as $prefectureId) {
                UserFavoritePrefecture::create([
                    'user_id' => $userId,
                    'prefecture_id' => $prefectureId,
                ]);
            }
        });
    }
}
