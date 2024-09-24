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
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class LoginAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = 'サービス利用者ログイン';

    /**
     * @param LoginRequest $request
     * @return CurrentServiceUserResource
     * @throws AuthenticationException
     * @throws AuthenticationTokenException
     * @throws UserStatusException
     * @throws TooManyRequestsHttpException
     */
    public function __invoke(LoginRequest $request): CurrentServiceUserResource
    {
        $ip = $request->ip();
        $email = $request->email;

        // レートリミットチェック
        if ($this->checkRateLimit($ip)) {
            throw new TooManyRequestsHttpException(null, 'ログイン試行回数が多すぎます。時間を空けてもう一度試してください。');
        }

        $user = ServiceUser::where('email', $email)->first();

        if (!$user) {
            $this->incrementFailedAttempts($ip);
            throw new AuthenticationException();
        }

        // 認証トークン整合性チェック
        if (!Hash::check($request->token, $user->onetime_token)) {
            $this->incrementFailedAttempts($ip);
            throw new AuthenticationTokenException(unmatched: true);
        }

        // 認証トークン有効期限チェック
        if ($user->onetime_expiration < Carbon::now()) {
            $this->incrementFailedAttempts($ip);
            throw new AuthenticationTokenException(expired: true);
        }

        // アカウントのステータスチェック
        if ($user->status !== ServiceUser::STATUS_ENABLED) {
            if ($user->status === ServiceUser::STATUS_PENDING) {
                throw new UserStatusException('ユーザーが登録されていません。', 401, null, 'pending');
            }
            throw new UserStatusException('アカウントが無効です。');
        }

        // 認証成功時
        Auth::guard('service_users')->login($user);

        // トークンを無効化
        $user->onetime_token = null;
        $user->onetime_expiration = null;
        $user->save();

        // 失敗カウントリセット
        $this->resetFailedAttempts($ip);

        $this->addOperationLog(OperationLog::OPERATION_TYPE_LOGIN, "ユーザーID", User::AuthId());

        $request->session()->regenerate();
        return new CurrentServiceUserResource($user);
    }

    private function checkRateLimit(string $ip): bool
    {
        $key = $this->throttleKey($ip);
        $attempts = RateLimiter::attempts($key);

        if ($attempts >= config('constant.login_rate_limit.max_attempts.level3')) {
            return RateLimiter::tooManyAttempts($key, config('constant.login_rate_limit.lockout_time.long'));
        } elseif ($attempts >= config('constant.login_rate_limit.max_attempts.level2')) {
            return RateLimiter::tooManyAttempts($key, config('constant.login_rate_limit.lockout_time.medium'));
        } elseif ($attempts >= config('constant.login_rate_limit.max_attempts.level1')) {
            return RateLimiter::tooManyAttempts($key, config('constant.login_rate_limit.lockout_time.short'));
        }

        return false;
    }

    private function incrementFailedAttempts(string $ip): void
    {
        $key = $this->throttleKey($ip);
        RateLimiter::hit($key, $this->decayMinutes($key) * 60);
    }

    private function resetFailedAttempts(string $ip): void
    {
        $key = $this->throttleKey($ip);
        RateLimiter::clear($key);
    }

    private function throttleKey(string $ip): string
    {
        return "login_attempts:{$ip}";
    }

    private function decayMinutes(string $key): int
    {
        $attempts = RateLimiter::attempts($key);

        if ($attempts >= config('constant.login_rate_limit.max_attempts.level3')) {
            return config('constant.login_rate_limit.lockout_time.long');
        } elseif ($attempts >= config('constant.login_rate_limit.max_attempts.level2')) {
            return config('constant.login_rate_limit.lockout_time.medium');
        } else {
            return config('constant.login_rate_limit.lockout_time.short');
        }
    }
}
