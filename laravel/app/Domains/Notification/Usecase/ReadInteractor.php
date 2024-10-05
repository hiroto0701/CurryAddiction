<?php

declare(strict_types=1);

namespace App\Domains\Notification\Usecase;

use App\Models\User;

class ReadInteractor
{
    public function handle(): void
    {
        $user = User::AuthUser();
        $user->unreadNotifications->markAsRead();
    }
}
