<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

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

    public function __invoke(Request $request): JsonResponse
    {
        $this->addOperationLog(OperationLog::OPERATION_TYPE_LOGOUT, "ユーザーID", User::AuthId());

        Auth::guard('service_users')->logout();
        // セッションの無効化と再作成
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
