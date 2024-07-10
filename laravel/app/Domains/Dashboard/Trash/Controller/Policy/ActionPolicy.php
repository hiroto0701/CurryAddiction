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


    public function delete($user): bool
    {
        if ($user instanceof ServiceUser || $user instanceof Administrator) {
            return true;
        }
        return false;
    }
}
