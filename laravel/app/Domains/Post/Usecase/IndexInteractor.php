<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Domains\Post\Usecase\Command\IndexCommand;
use App\Models\Post;
use App\Models\User;
use Carbon\CarbonImmutable as Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

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
        $query->where('user_id', '=', 3);

        $query->orderBy(
            self::SORT_KEYS[$command->getSortAttribute()] ?? 'updated_at',
            $command->getSortDirection() ?? 'desc'
        )->orderBy('created_at');

        return $query->paginate($command->getPerPage());
    }

}
