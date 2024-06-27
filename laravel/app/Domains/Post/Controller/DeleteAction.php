<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Usecase\DeleteInteractor;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction extends Controller
{
    protected DeleteInteractor $interactor;

    public function __construct(DeleteInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Post $post): JsonResponse
    {
        $this->interactor->handle($post);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

