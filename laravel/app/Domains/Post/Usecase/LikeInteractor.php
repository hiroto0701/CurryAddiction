<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Models\Like;
use App\Models\Post;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;

class LikeInteractor
{
      /**
     * @param Post $post
     * @return void
     */
    public function handle(Post $post, int $userId): bool
    {
        $serviceUser = ServiceUser::where('user_id', $userId)->firstOrFail();

        return DB::transaction(function () use ($post, $serviceUser) {
            $existingLike = $post->likes()->where('user_id', $serviceUser->user_id)->first();

            if ($existingLike) {
                $existingLike->delete();
                return true;
            }

            $like = new Like([
                'user_id' => $serviceUser->user_id,
                'post_id' => $post->id,
            ]);

            return $like->save();
        });
    }
}
