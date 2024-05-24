<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\RegisterRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Domains\ServiceUser\Usecase\Command\RegisterCommand;
use App\Domains\ServiceUser\Usecase\RegisterInteractor;
use App\Http\Controllers\Controller;

class RegisterAction extends Controller
{
    /**
     * @var RegisterInteractor
     */
    protected RegisterInteractor $interactor;

    /**
     * @param RegisterInteractor $interactor
     */
    public function __construct(RegisterInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(RegisterRequest $request): ServiceUserResource
    {
        $command = new RegisterCommand(
            $request->email,
            $request->handle_name,
        );

        return new ServiceUserResource(
            $this->interactor->handle($command)
        );
    }
}
