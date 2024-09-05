<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Usecase;

use App\Domains\Dashboard\Trash\Usecase\Command\IndexCommand;
use App\Models\Post;
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
        $query = Post::query()->onlyTrashed();

        if (!is_null($command->getUserId())) {
            $query->where('posts.user_id', '=', $command->getUserId());
        }

        $query->orderBy(
            self::SORT_KEYS[$command->getSortAttribute()] ?? 'deleted_at',
            $command->getSortDirection() ?? 'desc'
        )->orderBy('deleted_at');

        return $query->paginate($command->getPerPage());
    }
}
