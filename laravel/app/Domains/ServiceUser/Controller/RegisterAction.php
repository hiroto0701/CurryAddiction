<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\RegisterRequest;
use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
use App\Domains\ServiceUser\Usecase\Command\RegisterCommand;
use App\Domains\ServiceUser\Usecase\RegisterInteractor;
use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Traits\OperationLogTrait;

class RegisterAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'サービス利用者登録';

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

    public function __invoke(RegisterRequest $request): CurrentServiceUserResource
    {
        $command = new RegisterCommand(
            $request->email,
            $request->handle_name,
        );

        $serviceUser = new CurrentServiceUserResource(
            $this->interactor->handle($command)
        );

        $this->addOperationLog(OperationLog::OPERATION_TYPE_REGISTER, "ユーザーID", $serviceUser->user_id, $serviceUser->user_id);

        return $serviceUser;
    }
}
