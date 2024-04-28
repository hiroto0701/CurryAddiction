<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $email
 * @property string $password
 * @property string $name
 */
class Administrator extends Authenticatable
{
    use SoftDeletes;
    use OperatorRecordable;

    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

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
}
