<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Usecase\DeleteInteractor;
use App\Http\Controllers\Controller;
use App\Models\ServiceUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction extends Controller
{
    protected DeleteInteractor $interactor;

    public function __construct(DeleteInteractor $interactor)
    {
        $this->interactor = $interactor;
    }

    public function __invoke(Request $request, ServiceUser $serviceUser): JsonResponse
    {
        try {
            $this->interactor->handle($serviceUser);

            Auth::guard('service_users')->logout();
            $request->session()->flush();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'アカウントを削除しました。'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Account deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'アカウントの削除に失敗しました'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
