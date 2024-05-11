<?php

namespace App\Models;

use App\Models\ServiceUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $type
 * @property int $user_id
 * @property string $uuid
 * @property string $path
 * @property string $content_type
 * @property Carbon $uploaded_at
 */
class UploadFile extends Model
{
    use SoftDeletes;

    public const TYPE_AVATAR = 1;
    public const TYPE_POST_IMG = 2;

    protected $dates = [
        'uploaded_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;

    public function serviceUser(): BelongsTo
    {
        // service_userとのリレーション
        return $this->belongsTo(ServiceUser::class, 'id', 'avatar_id');
    }
}
