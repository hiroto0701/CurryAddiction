<?php

namespace App\Models;

use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type
 * @property string $subject
 * @property string $body
 * @property ManagementCompany $company
 */
class MailTemplate extends Model
{
    use OperatorRecordable;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public const TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN = 1;  // 確認コード通知メール 1

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;
}
