<?php

namespace App\Models;

use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Prefecture extends Model
{
    use HasFactory;
    use OperatorRecordable;


    protected $table = 'prefectures';

    protected $fillable = [
        'name',
        'region_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // created_at, updated_atの更新はObserverで一括して行う
    public $timestamps = false;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
