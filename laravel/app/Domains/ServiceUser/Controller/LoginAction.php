<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
use App\Exceptions\AuthenticationTokenException;
use App\Exceptions\UserStatusException;
use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\ServiceUser;
use App\Models\User;
use App\Traits\OperationLogTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'サービス利用者ログイン';

    /**
     * @param LoginRequest $request
     * @return CurrentServiceUserResource
     * @throws AuthenticationException  // 認証エラー
     * @throws AuthenticationTokenException  // トークンエラー
     * @throws UserStatusException  // ユーザー未登録エラー
     */
    public function __invoke(LoginRequest $request): CurrentServiceUserResource
    {
        $ip = $request->ip();
        $user = ServiceUser::where('email', $request->email)->first();

        if ($this->checkRateLimit($ip)) {
            throw new AuthenticationException('ログイン試行回数が多すぎます。時間を空けてもう一度試してください。');
        }

        if (!$user) {
            $this->incrementFailedAttempts($ip);
            throw new AuthenticationException();
        }

        if (!Hash::check($request->token, $user->onetime_token)) {
            $this->incrementFailedAttempts($ip);
            throw new AuthenticationTokenException(unmatched: true);
        }

        if ($user->onetime_expiration < Carbon::now()) {
            $this->incrementFailedAttempts($ip);
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

        // トークンを無効化
        $user->onetime_token = null;
        $user->onetime_expiration = null;
        $user->save();

        $this->addOperationLog(OperationLog::OPERATION_TYPE_LOGIN, "ユーザーID", User::AuthId());

        $request->session()->regenerate();
        return new CurrentServiceUserResource($user);
    }

    private function checkRateLimit(string $ip): bool
    {
        $key = $this->throttleKey($ip);
        $attempts = RateLimiter::attempts($key);

        if ($attempts >= 10) {
            return RateLimiter::tooManyAttempts($key, 60); // 1時間
        } else if ($attempts >= 5) {
            return RateLimiter::tooManyAttempts($key, 3); // 3分
        } else if ($attempts >= 3) {
            return RateLimiter::tooManyAttempts($key, 1); // 1分
        }

        return false;
    }

    private function incrementFailedAttempts(string $ip): void
    {
        $key = $this->throttleKey($ip);
        RateLimiter::hit($key, $this->decayMinutes($key) * 60);
    }

    private function throttleKey(string $ip): string
    {
        return $ip;
    }

    private function decayMinutes(string $key): int
    {
        $attempts = RateLimiter::attempts($key);

        if ($attempts >= 10) {
            return 60;
        } else if ($attempts >= 5) {
            return 3;
        } else {
            return 1;
        }
    }
}
