<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase;

// use App\Exceptions\AlreadyDeletedException;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DeleteInteractor
{
    /**
     * @param Post $post
     * @return void
     * @throws AlreadyDeletedException
     */
    public function handle(Post $post): void
    {
        // if ($issue->deleted_at !== null) {
        //     throw new AlreadyDeletedException();
        // }
        // Storage::disk('s3')->delete($post->path);  // TODO 例外処理やったほうがよさそうだけど、あとで調べる
        $post->delete();
    }
}
