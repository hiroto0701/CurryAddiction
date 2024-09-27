<?php

declare(strict_types=1);

namespace App\Domains\Genre\Usecase;

use App\Models\UserFavoriteGenre;
use Illuminate\Support\Facades\DB;

class FavoriteInteractor
{
    /**
     *
     * @param int $userId
     * @param array $genreIds
     * @return void
     */
    public function handle(int $userId, array $genreIds): void
    {
        DB::transaction(function () use ($userId, $genreIds) {
            UserFavoriteGenre::where('user_id', $userId)->delete();

            foreach ($genreIds as $genreId) {
                UserFavoriteGenre::create([
                    'user_id' => $userId,
                    'genre_id' => $genreId,
                ]);
            }
        });
    }
}
