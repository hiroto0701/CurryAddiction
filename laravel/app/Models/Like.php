<?php

namespace App\Models;

use App\Models\Post;
use App\Models\ServiceUser;
use App\Traits\OperatorRecordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Like extends Model
{
    use HasFactory;
    use Notifiable;
    use OperatorRecordable;

    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'post_id'
    ];

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
        return $this->belongsTo(ServiceUser::class, 'user_id', 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
