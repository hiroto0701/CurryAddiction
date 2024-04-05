<?php

declare(strict_types=1);

namespace App\Domains\Staff\Controller;

use App\Domains\Staff\Controller\Request\LoginRequest;
use App\Domains\Staff\Controller\Resource\StaffResource;
use App\Models\ManagementCompany;
use App\Models\Staff;
use App\Models\User;
use App\Models\OperationLog;
use App\Traits\OperationLogTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{
    use OperationLogTrait;

    public const OPERATION_OVERVIEW = '管理会社社員ログイン';

    /**
     * @param LoginRequest $request
     * @return StaffResource
     */
    public function __invoke(LoginRequest $request): StaffResource
    {
        // 認証
        if (!Auth::guard('staffs')->attempt($request->only(['email', 'password']) + [
            'status' => Staff::STATUS_ENABLED,
            function($query) {
                $query->whereHas('company', function($query) {
                    $query->whereIn('status', [ManagementCompany::STATUS_ENABLED, ManagementCompany::STATUS_SUSPEND]);
                });
            },
        ] + ['token' => $request->token])) {
            throw new AuthenticationException();
        }

        // 他の認証はログアウト
        Auth::guard('guests')->logout();
        Auth::guard('brokers')->logout();
        Auth::guard('administrators')->logout();
        // セッションを再生成
        $request->session()->regenerate();

        $this->addOperationLog(OperationLog::OPERATION_TYPE_LOGIN, "管理会社社員ID", User::AuthStaff()->id);

        return new StaffResource(User::AuthStaff());
    }
}
