<?php

declare(strict_types=1);

namespace App\Domains\Genre\Controller;

use App\Domains\Genre\Controller\Resource\GenreCollection;
use App\Domains\Genre\Usecase\IndexInteractor;
use Illuminate\Routing\Controller;

class IndexAction extends Controller
{
    public const OPERATION_OVERVIEW = 'カレージャンル取得';

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

    public function __invoke(): GenreCollection
    {
        return new GenreCollection(
            $this->interactor->handle()
        );
    }
}
