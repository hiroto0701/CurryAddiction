<?php

declare(strict_types=1);

namespace App\Domains\Notification\Usecase;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexInteractor
{
    public function handle(): LengthAwarePaginator
    {
       $user = User::AuthUser();

        $notifications = $user->notifications()->paginate(config('constant.api.max_notification_per_page'));
        $unreadCount = $user->unreadNotifications()->count();

        $notifications->unreadCount = $unreadCount;

        return $notifications;
    }
}
