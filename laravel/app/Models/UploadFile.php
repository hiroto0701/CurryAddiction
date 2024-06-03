<?php

namespace App\Models;

use App\Models\Post;
use App\Models\ServiceUser;
use App\Traits\OperatorRecordable;
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
    use OperatorRecordable;

    public const TYPE_AVATAR = 1;
    public const TYPE_POST_IMG = 2;

    protected $table = 'upload_files';

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
        return $this->belongsTo(ServiceUser::class, 'avatar_id');
    }

    public function postImg(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_img_id');
    }
}
