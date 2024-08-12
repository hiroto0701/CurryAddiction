<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OperatorRecordable;

class Genre extends Model
{
    use HasFactory;
    use OperatorRecordable;

    protected $table = 'likes';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'uploaded_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
