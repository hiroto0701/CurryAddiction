<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'notified_target' => $this->data['notified_target'] ?? null,
            'notified_from_user' => $this->data['notified_from_user'] ?? null,
            'created_at' => $this->created_at,
            'read_at' => $this->read_at,
        ];
    }
}
