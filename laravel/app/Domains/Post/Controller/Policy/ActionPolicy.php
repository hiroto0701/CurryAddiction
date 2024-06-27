<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('post-index', [self::class, 'index']);
        Gate::define('post-create', [self::class, 'create']);
        Gate::define('post-view', [self::class, 'view']);
        Gate::define('post-delete', [self::class, 'delete']);
    }

    public function index($user): bool
    {
        if ($user instanceof Administrator || $user instanceof ServiceUser) {
            return true;
        }
        return false;
    }

    public function create($user): bool
    {
        // 投稿を新規作成できるのはサービスユーザーのみ
        if ($user instanceof ServiceUser) {
            return true;
        }
        return false;
    }

    public function view($user): bool
    {
        if ($user instanceof ServiceUser || $user instanceof Administrator) {
            return true;
        }
        return false;
    }

    public function delete($user): bool
    {
        if ($user instanceof ServiceUser || $user instanceof Administrator) {
            return true;
        }
        return false;
    }
}
