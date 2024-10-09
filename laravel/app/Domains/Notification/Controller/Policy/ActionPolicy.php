<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('notification-index', [self::class, 'index']);
        Gate::define('notification-read', [self::class, 'read']);
    }

    public function index($user, $notification): bool
    {
        if ($user instanceof ServiceUser) {
            // 自分の通知のみ閲覧可能
            return $user->id === $notification->user_id;
        }
        if ($user instanceof Administrator) {
            // 管理者は全ての通知を閲覧可能
            return true;
        }
        return false;
    }

    public function read($user, $notification): bool
    {
        if ($user instanceof ServiceUser) {
            // 自分の通知のみ既読可能
            return $user->id === $notification->user_id;
        }
        return false;
    }
}
