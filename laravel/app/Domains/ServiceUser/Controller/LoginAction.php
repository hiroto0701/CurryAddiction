<?php

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
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
     * @return ServiceUserResource
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): ServiceUserResource
    {
        $request->session()->flush();
        $user = ServiceUser::where('email', $request->email)->first();

        if (!$user) {
            throw new AuthenticationException('Invalid email or token');
        }

        if (!Hash::check($request->token, $user->onetime_token)) {
            throw new AuthenticationException('Invalid email or token');
        }

        if ($user->onetime_expiration < Carbon::now()) {
            throw new AuthenticationException('Token expired');
        }

        Auth::guard('service_users')->login($user);

        $request->session()->regenerate();
        return new ServiceUserResource($user);
    }
}
