<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Http\Controllers\Controller;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{
    /**
     * @param LoginRequest $request
     * @return ServiceUserResource
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): ServiceUserResource
    {
        if (!Auth::guard('service_users')->attempt($request->only(['email']) + ['status' => ServiceUser::STATUS_ENABLED])) {
            throw new AuthenticationException();
        }

        $request->session()->regenerate();
        return new ServiceUserResource(User::AuthServiceUser());
    }
}
