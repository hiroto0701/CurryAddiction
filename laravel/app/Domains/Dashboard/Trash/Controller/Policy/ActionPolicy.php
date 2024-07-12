<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('trash-index', [self::class, 'index']);
        Gate::define('trash-delete', [self::class, 'delete']);
    }

    public function index($user): bool
    {
        if ($user instanceof Administrator || $user instanceof ServiceUser) {
            return true;
        }

        if ($user instanceof ServiceUser) {
            return $user->user_id === User::AuthId();
        }
        return false;
    }


    public function delete($user, $post): bool
    {
        if ($user instanceof ServiceUser) {
            // 自分の投稿のみ削除可能
            return $user->id === $post->user_id;
        }
        if ($user instanceof Administrator) {
            // 管理者は全ての投稿を削除可能
            return true;
        }
        return false;
    }
}
