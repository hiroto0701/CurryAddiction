<?php

declare(strict_types=1);

namespace App\Traits;

use App\Observers\OperatorRecord;

trait OperatorRecordable
{
    public static function bootOperatorRecordable()
    {
        self::observe(OperatorRecord::class);
    }
}
