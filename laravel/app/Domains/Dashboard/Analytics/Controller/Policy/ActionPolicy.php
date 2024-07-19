<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Analytics\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('analytics-index', [self::class, 'index']);
    }

    public function index($user): bool
    {
        // 本人及び管理者
        if ($user instanceof Administrator || $user instanceof ServiceUser) {
            return true;
        }

        if ($user instanceof ServiceUser) {
            return $user->user_id === User::AuthId();
        }
        return false;
    }

}
