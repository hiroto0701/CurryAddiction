<?php

namespace App\Models;

use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 * @property int $avatar_id
 * @property string $uuid
 * @property string $onetime_token
 * @property string $onetime_expiration
 * @property User $user
 */
class ServiceUser extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
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
        'avatar_id',
        'uuid',
        'onetime_token',
        'onetime_expiration',
        'registered_at',
    ];

    public const STATUS_DISABLED = 0;   // 利用不可
    public const STATUS_ENABLED = 1;    // 利用可
    public const STATUS_PENDING = 2;    // 仮登録
    public const STATUS_DELETED = 99;   // 削除済み

    public const STATUSES = [
        self::STATUS_DISABLED => '使用不可',
        self::STATUS_ENABLED => '使用可',
        self::STATUS_PENDING => '仮登録',
        self::STATUS_DELETED => '削除済み',
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

    public function avatar(): HasOne
    {
        return $this->hasOne(UploadFile::class, 'id', 'avatar_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'user_id', 'user_id');
    }

    public function favoriteGenres(): HasMany
    {
        return $this->hasMany(UserFavoriteGenre::class, 'user_id', 'user_id');
    }

    public function favoriteRegions(): HasMany
    {
        return $this->hasMany(UserFavoriteRegion::class, 'user_id', 'user_id');
    }

    public function favoritePrefectures(): HasMany
    {
        return $this->hasMany(UserFavoritePrefecture::class, 'user_id', 'user_id');
    }

}
