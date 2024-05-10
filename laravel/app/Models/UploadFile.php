<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
class Uploadfile extends Model
{
    use SoftDeletes;

    public const TYPE_AVATAR = 1;
    public const TYPE_POST_IMG = 2;

    // public const TYPE = [
    //     self::TYPE_REQUIRED_DOCUMENTS => '依頼主確認書類',
    //     self::TYPE_TRANSFER_STATEMENT => '振込明細',
    // ];

    protected $dates = [
        'uploaded_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;
}
