<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('service_user-update', [self::class, 'update']);
    }

    public function update($user, ServiceUser $serviceUser): bool
    {
        // 情報の修正は本人かシステム管理者
        if ($user instanceof ServiceUser) {
            return ($user->id === $serviceUser->id);
        } elseif ($user instanceof Administrator) {
            return true;
        }
        return false;
    }
}
