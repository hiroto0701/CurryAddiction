<?php

namespace App\Models;

use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $handle_name
 * @property string $display_name
 * @property string $email
 * @property string $password
 * @property string $profile_path
 * @property User $user
 */
class ServiceUser extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasFactory;
    use SoftDeletes;
    use OperatorRecordable;

    protected $table = 'service_users';

    protected $fillable = [
        'user_id',
        'status',
        'handle_name',
        'display_name',
        'email',
        'password',
        'profile_path',
        'prefecture_ids',
    ];

    public const STATUS_DISABLED = 0;   // 利用不可
    public const STATUS_ENABLED = 1;    // 利用可

    public const STATUSES = [
        self::STATUS_DISABLED => '使用不可',
        self::STATUS_ENABLED => '使用可',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
