<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Models\Like;
use App\Models\Post;
use App\Models\ServiceUser;
use App\Notifications\LikeNotification;
use Illuminate\Support\Facades\DB;

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

            /**
             * 通知の作成（条件）
             * - 投稿者が自分自身ではないこと
             * - 同一ユーザーの同一投稿に対するいいね通知は1度のみ
             */
            if ($result && $post->user_id !== $serviceUser->user_id) {
                $postOwner = ServiceUser::where('user_id', $post->user_id)->first();
                if ($postOwner) {
                    $alreadyNotified = $postOwner->notifications()
                        ->where('type', LikeNotification::class)
                        ->whereRaw("CAST(data AS json)->'notified_target'->>'post_id' = ?", [$post->id])
                        ->whereRaw("CAST(data AS json)->'notified_from_user'->>'user_id' = ?", [$serviceUser->user_id])
                        ->exists();

                    if (!$alreadyNotified) {
                        $postOwner->notify(new LikeNotification($post, $serviceUser));
                    }
                }
            }

            return $result;
        });
    }
}
