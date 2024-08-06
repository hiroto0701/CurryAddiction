<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\UpdateDisplayNameRequest;
use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
use App\Domains\ServiceUser\Usecase\Command\UpdateDisplayNameCommand;
use App\Domains\ServiceUser\Usecase\UpdateDisplayNameInteractor;
use App\Models\OperationLog;
use App\Models\User;
use App\Traits\OperationLogTrait;
use Illuminate\Routing\Controller;

class UpdateDisplayNameAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'サービス利用者表示名更新';

    /**
     * @var UpdateDisplayNameInteractor
     */
    protected UpdateDisplayNameInteractor $interactor;

    /**
     * @param UpdateDisplayNameInteractor $interactor
     */
    public function __construct(UpdateDisplayNameInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(UpdateDisplayNameRequest $request): CurrentServiceUserResource
    {
        $command = new UpdateDisplayNameCommand(
            $request->display_name,
        );

        $this->addOperationLog(OperationLog::OPERATION_TYPE_UPDATE, "ユーザーID", User::AuthId());

        return new CurrentServiceUserResource(
            $this->interactor->handle(User::AuthServiceUser(), $command)
        );
    }
}
