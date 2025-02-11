<?php

namespace App\Models;

use App\Models\Archive;
use App\Models\Like;
use App\Models\ServiceUser;
use App\Traits\OperatorRecordable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $post_img_id
 * @property int $region_id
 * @property int $prefecture_id
 * @property int $genre_id
 * @property string $store_name
 * @property string $comment
 * @property double $latitude
 * @property double $longitude
 * @property string $official_name
 * @property string $formatted_address
 * @property string $postcode
 * @property string $prefecture
 * @property string $municipality
 * @property string $ward
 * @property string $district
 * @property string $slug
 * @property Carbon $posted_at
 */
class Post extends Model
{
    use SoftDeletes;
    use OperatorRecordable;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_img_id',
        'region_id',
        'prefecture_id',
        'genre_id',
        'store_name',
        'comment',
        'latitude',
        'longitude',
        'official_name',
        'formatted_address',
        'prefecture',
        'municipality',
        'ward',
        'district',
        'slug',
        'posted_at',
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

    public function postImg(): HasOne
    {
        return $this->hasOne(UploadFile::class, 'id', 'post_img_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class, 'post_id');
    }
}
