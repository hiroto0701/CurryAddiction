<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Usecase\ArchiveInteractor;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArchiveAction extends Controller
{

    /**
     * @var ArchiveInteractor
     */
    protected ArchiveInteractor $interactor;

    /**
     * @param ArchiveInteractor $interactor
     */
    public function __construct(ArchiveInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Post $post): JsonResponse
    {
        $user = User::AuthId();
        $result = $this->interactor->handle($post, $user);

        if ($result) {
            return new JsonResponse([
                'message' => '保存しました',
            ], Response::HTTP_OK);
        }

        return new JsonResponse([
            'message' => '保存できませんでした',
        ], Response::HTTP_BAD_REQUEST);
    }
}
