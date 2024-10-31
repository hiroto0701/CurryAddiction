<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase;

use App\Domains\ServiceUser\Usecase\Command\UpdateAvatarCommand;
use App\Models\ServiceUser;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
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
        return DB::transaction(function () use ($service_user, $command) {

            if (!empty($command->getFileContent())) {
                $uploadDir = sprintf(config('constant.upload_files_path_format.avatar'), User::AuthId());

                $uploadfile = new UploadFile();
                $uploadfile->type = UploadFile::TYPE_AVATAR;
                $uploadfile->user_id = $command->getUserId();
                $uploadfile->uuid = Uuid::uuid4();
                $uploadfile->path = $uploadDir . $uploadfile->uuid . '.' . $command->getFileExtension();
                $uploadfile->content_type = $command->getContentType();
                $uploadfile->uploaded_at = Carbon::now();
                if (App::environment('local')) {
                    Storage::disk('s3')->put($uploadfile->path, $command->getFileContent());
                } else {
                    Storage::disk('r2')->put($uploadfile->path, $command->getFileContent());
                }
                $uploadfile->save();
            }
            $service_user->avatar_id = $uploadfile->id;
            $service_user->save();
            return $service_user;
        });
    }
}
