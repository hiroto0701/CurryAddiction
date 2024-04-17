<?php 

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Http\Controllers\Controller;
use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Models\ServiceUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        if (!Auth::guard('service_users')->attempt($request->only(['email', 'password']) + ['status' => ServiceUser::STATUS_ENABLED])) {
            throw new AuthenticationException();
        }
    
        $request->session()->regenerate();
    
        return new JsonResponse([
            'message' => 'Authenticated.',
        ]);
    }    
}
