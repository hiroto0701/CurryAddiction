<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Models\Archive;
use App\Models\Post;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;

class ArchiveInteractor
{
    /**
     * @param Post $post
     * @return void
     */
    public function handle(Post $post, int $userId): bool
    {
        $serviceUser = ServiceUser::where('user_id', $userId)->firstOrFail();

        return DB::transaction(function () use ($post, $serviceUser) {
            $alreadyArchive = $post->archives()->where('user_id', $serviceUser->user_id)->first();

            if ($alreadyArchive) {
                $alreadyArchive->delete();
                return true;
            }

            $Archive = new Archive([
                'user_id' => $serviceUser->user_id,
                'post_id' => $post->id,
            ]);

            return $Archive->save();
        });
    }
}
