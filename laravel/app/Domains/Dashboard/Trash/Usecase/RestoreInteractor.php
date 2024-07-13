<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Usecase;

use App\Exceptions\NotInTrashException;
use App\Models\Post;

class RestoreInteractor
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

        $post->restore();
    }
}
