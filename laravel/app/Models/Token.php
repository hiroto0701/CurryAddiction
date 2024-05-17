<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $token
 * @property boolean $is_verified
 * @property Carbon $expire_datetime
 */
class Token extends Model
{
    protected $fillable = [
        'email',
        'token',
        'is_verified',
        'expire_datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;
}
