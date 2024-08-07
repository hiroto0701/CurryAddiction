<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Http\Middleware\LoggingOperation;
use App\Models\OperationLog;
use App\Models\User;
use App\Traits\OperationLogTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'サービス利用者ログアウト';

    private LoggingOperation $loggingOperation;

    public function __invoke(Request $request): JsonResponse
    {
        // ログアウト後に操作ログを残すと認証ユーザが失われるため、ここで登録しておく
        $this->addOperationLog(OperationLog::OPERATION_TYPE_LOGOUT, "ユーザーID", User::AuthId());
        $this->loggingOperation->registerAuthUser(Auth::guard('service_users')->user());

        Auth::guard('service_users')->logout();
        // セッションの無効化と再作成
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
