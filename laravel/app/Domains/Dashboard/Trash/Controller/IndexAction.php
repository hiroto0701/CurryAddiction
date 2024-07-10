<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller;

use App\Domains\Dashboard\Trash\Controller\Request\IndexRequest;
use App\Domains\Dashboard\Trash\Controller\Resource\TrashCollection;
use App\Domains\Dashboard\Trash\Usecase\Command\IndexCommand;
use App\Domains\Dashboard\Trash\Usecase\IndexInteractor;
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

    public function __invoke(IndexRequest $request): TrashCollection
    {
        $command = new IndexCommand(
            $request->userId ?? null,
            $request->page ? (int)$request->page : 1,
            $request->per_page ? (int)$request->per_page : config('constant.api.max_item_per_page'),
            $request->sort_attribute,
            $request->sort_direction,
        );

        return new TrashCollection(
            $this->interactor->handle($command)
        );
    }
}
