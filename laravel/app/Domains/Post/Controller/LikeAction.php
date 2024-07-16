<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Usecase\LikeInteractor;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class LikeAction extends Controller
{

    /**
     * @var LikeInteractor
     */
    protected LikeInteractor $interactor;

    /**
     * @param LikeInteractor $interactor
     */
    public function __construct(LikeInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Post $post): JsonResponse
    {
        $user = User::AuthId();
        $result = $this->interactor->handle($post, $user);

        if ($result) {
            return new JsonResponse([
                'message' => 'いいねしました',
            ], Response::HTTP_OK);
        }

        return new JsonResponse([
            'message' => 'いいねできませんでした',
        ], Response::HTTP_BAD_REQUEST);
    }
}
