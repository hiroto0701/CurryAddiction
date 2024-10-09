<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller;

use App\Domains\Notification\Controller\Resource\NotificationCollection;
use App\Domains\Notification\Usecase\IndexInteractor;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class IndexAction extends Controller
{
    public const OPERATION_OVERVIEW = '通知一覧取得';

    /**
     * @var IndexInteractor
     */
    protected IndexInteractor $interactor;

    /**
     * @param IndexInteractor $interactor
     */
    public function __construct(IndexInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Request $request): NotificationCollection
    {
        return new NotificationCollection(
            $this->interactor->handle()
        );
    }
}
