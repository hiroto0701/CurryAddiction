<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Domains\Post\Usecase\Command\IndexCommand;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexInteractor
{
    private const SORT_KEYS = [
        'posted_at' => 'posted_at',
        'updated_at' => 'updated_at',
    ];

    /**
     *
     * @param IndexCommand $command
     *
     * @return LengthAwarePaginator
     */
    public function handle(IndexCommand $command): LengthAwarePaginator
    {
        $query = Post::query();

        if (!is_null($command->getUserId())) {
            $query->where('posts.user_id', '=', $command->getUserId());
        }

        if (!is_null($command->getIsLiked()) && $command->getIsLiked()) {
            $query->whereHas('likes', function ($query) {
                $query->where('user_id', User::AuthId());
            });
        }

        if (!is_null($command->getIsArchived()) && $command->getIsArchived()) {
            $query->whereHas('archives', function ($query) {
                $query->where('user_id', User::AuthId());
            });
        }

        if (!empty($command->getFavoriteGenres())) {
            $query->whereIn('genre_id', $command->getFavoriteGenres());
        }

        if (!empty($command->getFavoritePrefectures())) {
            $query->whereIn('prefecture_id', $command->getFavoritePrefectures());
        }

        $query->with([
            'likes' => function ($query) {
                $query->where('user_id', User::AuthId());
            },
            'archives' => function ($query) {
                $query->where('user_id', User::AuthId());
            },
        ]);

        $query->orderBy(
            self::SORT_KEYS[$command->getSortAttribute()] ?? 'posted_at',
            $command->getSortDirection() ?? 'desc'
        )->orderBy('posts.created_at');

        return $query->paginate($command->getPerPage());

    }
}
