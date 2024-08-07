<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class LoggingOperation
{
    private Authenticatable $authUser;

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function registerAuthUser(Authenticatable $user)
    {
        $this->authUser = $user;
    }

    public function terminate(Request $request, Response $response)
    {
        $operationDetail = sprintf(
            '%s %s %s %s %s',
            $request->getClientIp(),
            $this->getUserInfo(),
            $this->getOperation($request),
            $this->getResult($response),
            $request->userAgent()
        );
        Log::channel('operation')->info($operationDetail);
    }

    private function getUserInfo(): string
    {
        $user = $this->authUser ?? User::AuthUser();
        if ($user) {
            return sprintf('%s(%d)', $user->name, $user->user_id);
        }
        return '未認証ユーザ';
    }

    private function getOperation(Request $request): string
    {
        $overview = $this->getOperationConstant('OVERVIEW');
        if ($overview === null) {
            return sprintf('操作内容未定義[%s]', Route::currentRouteAction());
        }

        $targetResource = $this->getOperationConstant('TARGET_RESOURCE');
        if ($targetResource !== null) {
            $targetResourceId = $request->route()->originalParameter($this->getOperationConstant('TARGET_PARAMETER'));
            return sprintf('%s %sID:%s', $overview, $targetResource, $targetResourceId ?? 'Unknown');
        }

        $targetFiles = $this->getOperationConstant('TARGET_FILES');
        if ($targetFiles !== null) {
            $fileType = $targetFiles[$request->type] ?? '不明なファイル種別';
            return sprintf('%s %sUUID:%s', $overview, $fileType, $request->uuid ?? 'Unknown');
        }

        return $overview;
    }

    private function getOperationConstant(string $constantName)
    {
        $constantFullName = sprintf('%s::OPERATION_%s', Route::currentRouteAction(), $constantName);
        return defined($constantFullName) ? constant($constantFullName) : null;
    }

    private function getResult($response): string
    {
        if ($response instanceof Response) {
            if ($response->isSuccessful()) {
                return '成功';
            }
            if ($response->isServerError()) {
                return 'サーバーエラー';
            }
            return match ($response->getStatusCode()) {
                Response::HTTP_BAD_REQUEST => '失敗',
                Response::HTTP_UNAUTHORIZED => '失敗（認証エラー OR セッションタイムアウト）',
                Response::HTTP_FORBIDDEN => '失敗（許可されていない操作）',
                Response::HTTP_NOT_FOUND => '失敗（存在しないリソースの操作）',
                Response::HTTP_CONFLICT => '失敗（衝突）',
                Response::HTTP_GONE => '失敗（処理済）',
                Response::HTTP_UNPROCESSABLE_ENTITY => '失敗（バリデーションエラー）',
                default => '失敗（詳細不明）',
            };
        }
        return 'Unknown';
    }
}
