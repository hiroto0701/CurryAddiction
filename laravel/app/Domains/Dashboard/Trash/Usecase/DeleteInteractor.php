<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Usecase;

use App\Exceptions\NotInTrashException;
use App\Models\Post;
use App\Models\UploadFile;
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
            // 画像ファイルの削除
            $uploadFile = UploadFile::find($post->post_img_id);
            if ($uploadFile) {
                Storage::disk('s3')->delete($uploadFile->path);
                $uploadFile->delete();
            }

            // 投稿を削除（ハードデリート）
            $post->forceDelete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
