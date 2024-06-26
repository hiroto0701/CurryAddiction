<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
use App\Exceptions\AuthenticationTokenException;
use App\Exceptions\UserStatusException;
use App\Http\Controllers\Controller;
use App\Models\ServiceUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAction extends Controller
{
    /**
     * @param LoginRequest $request
     * @return CurrentServiceUserResource
     * @throws AuthenticationException  // 認証エラー
     * @throws AuthenticationTokenException  // トークンエラー
     * @throws UserStatusException  // ユーザー未登録エラー
     */
    public function __invoke(LoginRequest $request): CurrentServiceUserResource
    {
        $user = ServiceUser::where('email', $request->email)->first();

        if (!$user) {
            throw new AuthenticationException();
        }

        if (!Hash::check($request->token, $user->onetime_token)) {
            throw new AuthenticationTokenException(unmatched: true);
        }

        if ($user->onetime_expiration < Carbon::now()) {
            throw new AuthenticationTokenException(expired: true);
        }

        if ($user->status !== ServiceUser::STATUS_ENABLED) {
            // アカウント未登録時はpendingをthrowする
            if ($user->status === ServiceUser::STATUS_PENDING) {
                throw new UserStatusException('The user is not registered.', 401, null, 'pending');
            }
            throw new UserStatusException();
        }

        Auth::guard('service_users')->login($user);

        $request->session()->regenerate();
        return new CurrentServiceUserResource($user);
    }
}
