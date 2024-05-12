<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Resource;

use App\Http\Controllers\FileViewAction;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceUserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'handle_name' => $this->handle_name,
            'display_name' => $this->display_name,
            'email' => $this->email,
            'avatar' => $this->avatar ? route(
                'file.view',
                ['type' => FileViewAction::TYPE_AVATAR, 'uuid' => $this->avatar->uuid]
            ) : null,
            'created_at' => $this->created_at,
        ];
    }
}
