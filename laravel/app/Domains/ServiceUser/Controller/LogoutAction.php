<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        Auth::guard('service_users')->logout();
        // セッションの無効化と再作成
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
