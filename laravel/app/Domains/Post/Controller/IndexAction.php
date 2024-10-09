<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Controller\Request\IndexRequest;
use App\Domains\Post\Controller\Resource\PostCollection;
use App\Domains\Post\Usecase\Command\IndexCommand;
use App\Domains\Post\Usecase\IndexInteractor;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class IndexAction extends Controller
{
    public const OPERATION_OVERVIEW = '投稿一覧取得';

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

    public function __invoke(IndexRequest $request): PostCollection
    {
        $command = new IndexCommand(
            $request->userId ?? null,
            $request->page ? (int)$request->page : 1,
            $request->per_page ? (int)$request->per_page : config('constant.api.max_post_per_page'),
            (boolean)$request->isLiked ?? null,
            (boolean)$request->isArchived ?? null,
            $request->favorite_genres ?? [],
            $request->sort_attribute,
            $request->sort_direction,
        );

        return new PostCollection(
            $this->interactor->handle($command)
        );
    }
}
