<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\RegisterCommand;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\DB;

class RegisterInteractor
{
    /**
     * @param ServiceUser $service_user
     * @param RegisterCommand $command
     * @return ServiceUser
     */
    public function handle(RegisterCommand $command)
    {
        return DB::transaction(function () use ($command) {
            $service_user = ServiceUser::where('email', $command->getEmail())->first();

            // 登録時はhandle_nameとdisplay_nameを統一する
            $service_user->update([
                'handle_name' => $command->getHandleName(),
                'display_name' => $command->getHandleName(),
                'status' => ServiceUser::STATUS_ENABLED,
            ]);
            return $service_user;
        });
    }
}
