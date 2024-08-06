<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Exceptions\AlreadyDeletedException;
use App\Models\Post;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;

class DeleteInteractor
{
    /**
     * @param ServiceUser $serviceUser
     * @return void
     * @throws AlreadyDeletedException
     * @throws \Exception
     */
    public function handle(ServiceUser $serviceUser): void
    {
        if ($serviceUser->trashed()) {
            throw new AlreadyDeletedException('このアカウントは既に削除されています');
        }

        DB::beginTransaction();
        try {
            $user = $serviceUser->user;

            if ($user) {
                // 投稿削除
                Post::where('user_id', $user->id)->delete();

                // Userモデル削除
                $user->delete();
            }

            $this->updateEmail($serviceUser);

            // ServiceUserモデル削除
            $serviceUser->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * 同一メールアドレス登録できるようにunique制限を避けるためメールアドレスを更新する
     * ※ handle_name は更新しない
     *
     * @param ServiceUser $serviceUser
     */
    private function updateEmail($serviceUser): void
    {
        $originalEmail = $serviceUser->email;
        $newEmail = '【DELETED_' . time() . '】' . $originalEmail;
        $serviceUser->email = $newEmail;
        $serviceUser->save();
    }
}
