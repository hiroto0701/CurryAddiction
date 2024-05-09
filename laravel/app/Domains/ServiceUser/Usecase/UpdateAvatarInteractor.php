<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\UpdateAvatarCommand;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UpdateAvatarInteractor
{
    /**
     * @param ServiceUser $service_user
     * @param UpdateAvatarCommand $command
     * @return ServiceUser
     */
    public function handle(ServiceUser $service_user, UpdateAvatarCommand $command): ServiceUser
    {
        return DB::transaction(function () use ($command, $service_user) {

            if (!empty($command->getFilename())) {
                $fileUuid = Uuid::uuid4();
                $service_user->profile_path = sprintf(
                    config('constant.avatar.uploadfiles_path_format'),
                    User::AuthId()
                ) . $fileUuid . '.' . $command->getFileExtension();

                Storage::disk('s3')->put($service_user->profile_path, $command->getFileContent());
            }
            $service_user->save();
            return $service_user;
        });
    }
}
