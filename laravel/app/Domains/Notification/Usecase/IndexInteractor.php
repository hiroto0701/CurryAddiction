<?php

declare(strict_types=1);

namespace App\Domains\Notification\Usecase;

use App\Http\Controllers\FileViewAction;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexInteractor
{
    public function handle(): LengthAwarePaginator
    {
        $user = User::AuthUser();

        $notifications = $user->notifications()->paginate(config('constant.api.max_notification_per_page'));
        $unreadCount = $user->unreadNotifications()->count();

        $userIds = $notifications->pluck('data.notified_from_user.user_id')->unique()->toArray();
        $users = User::whereIn('id', $userIds)
            ->with(['service_user.avatar'])
            ->get()
            ->keyBy('id');

        $notifications->getCollection()->transform(function ($notification) use ($users) {
            $notificationData = $notification->data;

            if (isset($notificationData['notified_from_user']) && isset($notificationData['notified_from_user']['user_id'])) {
                $fromUser = $users->get($notificationData['notified_from_user']['user_id']);
                if ($fromUser && $fromUser->service_user) {
                    $notificationData['notified_from_user']['avatar_url'] = $fromUser->service_user->avatar
                        ? route('file.view', ['type' => FileViewAction::TYPE_AVATAR, 'uuid' => $fromUser->service_user->avatar->uuid])
                        : null;
                }
            }

            $notification->data = $notificationData;
            return $notification;
        });

        $notifications->unreadCount = $unreadCount;

        return $notifications;
    }
}
