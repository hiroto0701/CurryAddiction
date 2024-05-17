<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Exceptions\AuthenticationTokenException;
use App\Http\Controllers\Controller;
use App\Models\ServiceUser;
use App\Models\Token;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{
    /**
     * @param LoginRequest $request
     * @return ServiceUserResource
     * @throws AuthenticationException
     */
    public function validateToken(LoginRequest $request) {
        // トークンを検証する
        // $twoStepAuthentications = $user->twoStepAuthentications->filter(function ($twoStepAuthentication) use ($credentials) {
        //     if ($twoStepAuthentication->token != $credentials['token']) return false;
        //     if ($twoStepAuthentication->expire_datetime < Carbon::now()) return false;
        //     return true;
        // });

        $tokenData = Token::where('email', $request->email)->first();

        if ($tokenData->token != $request->token) return false;
        if ($tokenData->expire_datetime < Carbon::now()) return false;


        // if ($twoStepAuthentications->count() == 0) throw new AuthenticationTokenException(unmatched: true);
        return true;
    }

    public function __invoke(LoginRequest $request): ServiceUserResource
    {
        $request->session()->flush();

        // 存在チェックして、存在していたらservice_user_eloquent_user_providerの方に処理を移す
        if ($this->validateToken($request)) {
            if (ServiceUser::where('email', $request->email)->exists()) {
                if (!Auth::guard('service_users')->attempt($request->only(['email', 'token']) + ['status' => ServiceUser::STATUS_ENABLED])) {
                    throw new AuthenticationException();
                }
            }

            $request->session()->regenerate();
        }
        return new ServiceUserResource(User::AuthServiceUser());
    }
}
