<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Controller\Request\IndexRequest;
use App\Domains\Post\Controller\Resource\PostCollection;
use App\Domains\Post\Usecase\Command\IndexCommand;
use App\Domains\Post\Usecase\IndexInteractor;
use Illuminate\Routing\Controller;

class IndexAction extends Controller
{
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
            $request->page ? (int)$request->page : 1,
            $request->per_page ? (int)$request->per_page : config('constant.api.max_item_per_page'),
            $request->sort_attribute,
            $request->sort_direction,
        );

        return new PostCollection(
            $this->interactor->handle($command)
        );
    }
}
