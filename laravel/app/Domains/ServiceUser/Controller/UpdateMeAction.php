<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\UpdateMeRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Domains\ServiceUser\Usecase\Command\UpdateMeCommand;
use App\Domains\ServiceUser\Usecase\UpdateMeInteractor;
use App\Models\User;
use Illuminate\Routing\Controller;

class UpdateMeAction extends Controller
{
    /**
     * @var UpdateMeInteractor
     */
    protected UpdateMeInteractor $interactor;

    /**
     * @param UpdateMeInteractor $interactor
     */
    public function __construct(UpdateMeInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(UpdateMeRequest $request): ServiceUserResource
    {
        $command = new UpdateMeCommand(
            $request->display_name,
        );

        return new ServiceUserResource(
            $this->interactor->handle(User::AuthServiceUser(), $command)
        );
    }
}
