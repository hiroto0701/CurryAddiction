<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $type
 * @property ServiceUser $service_user
 * @property Administrator $administrator
 */
class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TYPE_SERVICE_USER = 1;
    public const TYPE_ADMINISTRATOR = 2;

    public const TYPES = [
        self::TYPE_SERVICE_USER => 'サービス利用者',
        self::TYPE_ADMINISTRATOR => 'システム管理者',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;

    public static function AuthUser(): ?Authenticatable
    {
        return self::AuthServiceUser() ?? self::AuthAdministrator();
    }

    public static function AuthServiceUser(): ?ServiceUser
    {
        $service_user = Auth::guard('service_users')->user();
        if ($service_user instanceof ServiceUser) {
            return $service_user;
        }
        return null;
    }

    // public static function AuthAdministrator(): ?Administrator
    // {
    //     $administrator = Auth::guard('administrators')->user();
    //     if ($administrator instanceof Administrator) {
    //         return $administrator;
    //     }
    //     return null;
    // }

    public static function AuthId($default = null): ?int
    {
        return self::AuthUser()->user_id ?? $default;
    }

    public static function AuthType($type = null): mixed
    {
        if (self::AuthServiceUser()) {
            return ($type !== null) ? $type === self::TYPE_SERVICE_USER : self::TYPE_SERVICE_USER;
        }
        if (self::AuthAdministrator()) {
            return ($type !== null) ? $type === self::TYPE_ADMINISTRATOR : self::TYPE_ADMINISTRATOR;
        }
        return ($type !== null) ? false : null;
    }

    public function service_user(): HasOne
    {
        return $this->hasOne(ServiceUser::class);
    }

    // public function administrator(): HasOne
    // {
    //     return $this->hasOne(Administrator::class);
    // }
}
