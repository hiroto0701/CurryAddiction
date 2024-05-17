<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\SendTokenRequest;
use App\Domains\ServiceUser\Usecase\Command\TokenCreateCommand;
use App\Domains\ServiceUser\Usecase\TokenCreateInteractor;
use App\Http\Controllers\Controller;

class GenerateAuthTokenAction extends Controller
{
    /**
     * @var TokenCreateInteractor
     */
    protected TokenCreateInteractor $interactor;

    /**
     * @param TokenCreateInteractor $interactor
     */
    public function __construct(TokenCreateInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(SendTokenRequest $request)
    {
        $command = new TokenCreateCommand(
            $request->email,
            str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT),
        );

        $this->interactor->handle($command);
    }
}
