<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller;

use App\Domains\Dashboard\Trash\Usecase\RestoreInteractor;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RestoreAction extends Controller
{
    public const OPERATION_OVERVIEW = '削除済み投稿（論理削除）復元';

    protected RestoreInteractor $interactor;

    public function __construct(RestoreInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Post $post): JsonResponse
    {
        try {
            $this->interactor->handle($post);
            return response()->json([
                'success' => true,
                'message' => '投稿を復元しました。'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Post restore failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => '投稿の復元に失敗しました'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
