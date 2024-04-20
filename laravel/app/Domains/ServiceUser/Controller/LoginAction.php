<?php 

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller;

use App\Http\Controllers\Controller;
use App\Domains\ServiceUser\Controller\Request\LoginRequest;
use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
use App\Models\ServiceUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginAction extends Controller
{
    /**
     * @param LoginRequest $request
     * @return ServiceUserResource
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): ServiceUserResource
    {
        if (!Auth::guard('service_users')->attempt($request->only(['email', 'password']) + ['status' => ServiceUser::STATUS_ENABLED])) {
            throw new AuthenticationException();
        }
    
        $request->session()->regenerate();
        return new ServiceUserResource(User::AuthServiceUser());
    }    
}
