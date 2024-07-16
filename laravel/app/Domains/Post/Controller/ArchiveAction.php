<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Controller\Request\CreateRequest;
use App\Domains\Post\Controller\Resource\PostResource;
use App\Domains\Post\Usecase\Command\CreateCommand;
use App\Domains\Post\Usecase\CreateInteractor;
use App\Models\User;
use Illuminate\Routing\Controller;

class ArchiveAction extends Controller
{

    /**
     * @var CreateInteractor
     */
    protected CreateInteractor $interactor;

    /**
     * @param CreateInteractor $interactor
     */
    public function __construct(CreateInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(CreateRequest $request): PostResource
    {
        $command = new CreateCommand(
            User::AuthId(),
            (int)$request->genre_id,
            (int)$request->region_id,
            (int)$request->prefecture_id,
            $request->store_name,
            !is_null($request->comment) ? $request->comment : null,
            (float)$request->latitude,
            (float)$request->longitude,
            $request->post_img->get(),
            $request->post_img->getClientOriginalName(),
            $request->post_img->getClientOriginalExtension(),
            $request->post_img->getMimeType(),
        );
        $result = new PostResource(
            $this->interactor->handle($command)
        );

        return $result;
    }
}
