<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Analytics\Usecase;

use App\Domains\Dashboard\Analytics\Usecase\Command\IndexCommand;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class IndexInteractor
{
    /**
     * @param IndexCommand $command
     */
    public function handle(IndexCommand $command)
    {
        $query = Post::query()
            ->where('posts.user_id', '=', $command->getUserId())
            ->select(
                DB::raw('DATE(posted_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('DATE(posted_at)'))
            ->orderBy('date', 'desc');

        return $query->get();
    }
}
