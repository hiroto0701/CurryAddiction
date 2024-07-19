<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Analytics\Controller\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => $this->date,
            'count' => $this->count,
        ];
    }
}
