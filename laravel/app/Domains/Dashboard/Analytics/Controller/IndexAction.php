<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Analytics\Controller;

use App\Domains\Dashboard\Analytics\Controller\Request\IndexRequest;
use App\Domains\Dashboard\Analytics\Controller\Resource\AnalyticsCollection;
use App\Domains\Dashboard\Analytics\Usecase\Command\IndexCommand;
use App\Domains\Dashboard\Analytics\Usecase\IndexInteractor;
use App\Models\User;
use Illuminate\Routing\Controller;

class IndexAction extends Controller
{
    public const OPERATION_OVERVIEW = 'ダッシュボード分析 - ユーザーの日別の投稿数取得';

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

    public function __invoke(IndexRequest $request): AnalyticsCollection
    {
        $command = new IndexCommand(
            User::AuthId(),
            $request->sort_attribute,
            $request->sort_direction,
        );

        return new AnalyticsCollection(
            $this->interactor->handle($command)
        );
    }
}
