<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property string $token
 * @property Carbon $expire_datetime
 */
class TwoStepAuthentication extends Model
{
    // プライマリーキー無効(id)
    protected $primaryKey = null;

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;
    // AutoIncrement無効
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
