<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\UpdateDisplayNameCommand;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;

class UpdateDisplayNameInteractor
{
    /**
     * @param ServiceUser $service_user
     * @param UpdateDisplayNameCommand $command
     * @return ServiceUser
     */
    public function handle(ServiceUser $service_user, UpdateDisplayNameCommand $command): ServiceUser
    {
        return DB::transaction(function () use ($command, $service_user) {
            $service_user->display_name = $command->getDisplayName();
            $service_user->save();
            return $service_user;
        });
    }
}
