<?php

declare(strict_types=1);

namespace App\Domains\Prefecture\Controller\Policy;

use App\Models\Administrator;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\Gate;

class ActionPolicy
{
    public static function register()
    {
        Gate::define('prefecture-favorite', [self::class, 'favorite']);
    }

    public function favorite($user): bool
    {
        if ($user instanceof Administrator || $user instanceof ServiceUser) {
            return true;
        }
        return false;
    }
}
