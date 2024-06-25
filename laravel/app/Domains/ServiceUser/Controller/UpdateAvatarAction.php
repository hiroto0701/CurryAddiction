<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\UpdateAvatarRequest;
use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
use App\Domains\ServiceUser\Usecase\Command\UpdateAvatarCommand;
use App\Domains\ServiceUser\Usecase\UpdateAvatarInteractor;
use App\Models\User;
use Illuminate\Routing\Controller;

class UpdateAvatarAction extends Controller
{
    /**
     * @var UpdateAvatarInteractor
     */
    protected UpdateAvatarInteractor $interactor;

    /**
     * @param UpdateAvatarInteractor $interactor
     */
    public function __construct(UpdateAvatarInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(UpdateAvatarRequest $request): CurrentServiceUserResource
    {
        $command = new UpdateAvatarCommand(
            User::AuthId(),
            $request->file_data ? $request->file_data->get() : null,
            $request->file_data ? $request->file_data->getClientOriginalName() : null,
            $request->file_data ? $request->file_data->getClientOriginalExtension() : null,
            $request->file_data ? $request->file_data->getMimeType() : null,
        );

        return new CurrentServiceUserResource(
            $this->interactor->handle(User::AuthServiceUser(), $command)
        );
    }
}
