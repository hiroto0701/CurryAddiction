<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\SendTokenRequest;
use App\Domains\ServiceUser\Usecase\Command\TokenCreateCommand;
use App\Domains\ServiceUser\Usecase\TokenCreateInteractor;
use App\Http\Controllers\Controller;

class GenerateAuthTokenAction extends Controller
{
    public const OPERATION_OVERVIEW = 'ログイン用トークン生成';

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
            bin2hex(random_bytes(4))
        );

        $this->interactor->handle($command);
    }
}
