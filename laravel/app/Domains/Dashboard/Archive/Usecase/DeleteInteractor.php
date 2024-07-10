<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

use App\Exceptions\AlreadyDeletedException;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DeleteInteractor
{
    /**
     * @param Post $post
     * @return void
     * @throws AlreadyDeletedException
     * @throws \Exception
     */
    public function handle(Post $post): void
    {
        if ($post->trashed()) {
            throw new AlreadyDeletedException('この投稿は既に削除されています');
        }

        DB::beginTransaction();
        try {
            // 投稿を削除（ソフトデリート）
            $post->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}