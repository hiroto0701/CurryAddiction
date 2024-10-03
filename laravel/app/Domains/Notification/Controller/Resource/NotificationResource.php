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
            'notification_items' => $this->data,
            'created_at' => $this->created_at,
            'read_at' => $this->read_at,
        ];
    }
}
