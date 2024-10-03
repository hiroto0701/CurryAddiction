<?php

declare(strict_types=1);

namespace App\Domains\Notification\Usecase;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexInteractor
{
    public function handle(): LengthAwarePaginator
    {
        return User::AuthUser()->notifications()->paginate(config('constant.api.max_notification_per_page'));
    }
}
