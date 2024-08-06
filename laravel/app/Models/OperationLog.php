<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Carbon $operated_at
 * @property int $user_id
 * @property int $operation_type
 * @property string $name
 * @property string $value
 * @property string $namespace
 * @property string $class_name
 * @property string $api_name
 */
class OperationLog extends Model
{
    public const OPERATION_TYPE_LOGIN = 1;
    public const OPERATION_TYPE_REGISTER = 2;
    public const OPERATION_TYPE_UPDATE = 3;
    public const OPERATION_TYPE_DELETE = 4;
    public const OPERATION_TYPE_LOGOUT = 5;

    public const OPERATION_TYPES = [
        self::OPERATION_TYPE_LOGIN => 'ログイン',
        self::OPERATION_TYPE_REGISTER => '登録',
        self::OPERATION_TYPE_UPDATE => '更新',
        self::OPERATION_TYPE_DELETE => '削除',
        self::OPERATION_TYPE_LOGOUT => 'ログアウト',
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
