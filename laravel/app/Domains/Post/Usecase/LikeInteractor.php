<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Models\Like;
use App\Models\Post;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;
use App\Notifications\LikeNotification;

class LikeInteractor
{
    /**
     * @param Post $post
     * @param int $userId
     * @return bool
     */
    public function handle(Post $post, int $userId): bool
    {
        $serviceUser = ServiceUser::where('user_id', $userId)->firstOrFail();

        return DB::transaction(function () use ($post, $serviceUser) {
            $alreadyLike = $post->likes()->where('user_id', $serviceUser->user_id)->first();

            if ($alreadyLike) {
                $alreadyLike->delete();
                // いいねを取り消した場合は通知を送信しない
                return true;
            }

            $like = new Like([
                'user_id' => $serviceUser->user_id,
                'post_id' => $post->id,
            ]);

            $result = $like->save();

            // いいねを追加し、投稿者が自分自身でない場合に通知を送信
            if ($result && $post->user_id !== $serviceUser->user_id) {
                $postOwner = ServiceUser::where('user_id', $post->user_id)->first();
                if ($postOwner) {
                    $postOwner->notify(new LikeNotification($post, $serviceUser));
                }
            }

            return $result;
        });
    }
}
