<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Usecase;

use App\Exceptions\NotInTrashException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteInteractor
{
    /**
     * @param Post $post
     * @return void
     * @throws NotInTrashException
     * @throws \Exception
     */
    public function handle(Post $post): void
    {
        if (!$post->trashed()) {
            throw new NotInTrashException('この投稿はごみ箱に入っていません');
        }

        DB::beginTransaction();
        try {
            // 投稿を削除（ハードデリート）
            $post->forceDelete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
