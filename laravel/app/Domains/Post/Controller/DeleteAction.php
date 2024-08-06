<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller;

use App\Domains\Post\Usecase\DeleteInteractor;
use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\Post;
use App\Models\User;
use App\Traits\OperationLogTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = '投稿削除（論理削除）';

    protected DeleteInteractor $interactor;

    public function __construct(DeleteInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Post $post): JsonResponse
    {
        try {
            $this->interactor->handle($post);

            $this->addOperationLog(OperationLog::OPERATION_TYPE_DELETE, "投稿ID", $post->id);

            return response()->json([
                'success' => true,
                'message' => '投稿をごみ箱に入れました。'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Post deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => '投稿の削除に失敗しました'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
