<?php

declare(strict_types=1);

namespace App\Domains\Staff\Controller;

use App\Domains\Staff\Controller\Request\LoginRequest;
use App\Models\ManagementCompany;
use App\Models\Staff;
use App\Models\User;
use App\Models\OperationLog;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{
  /**
   * @param LoginRequest $request
   */
  public function __invoke(LoginRequest $request)
  {
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
