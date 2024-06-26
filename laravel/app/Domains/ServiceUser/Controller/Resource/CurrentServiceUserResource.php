<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Controller\Resource;

use App\Http\Controllers\FileViewAction;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentServiceUserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'handle_name' => $this->handle_name,
            'display_name' => $this->display_name,
            'email' => $this->email,
            'avatar_url' => $this->avatar ? route(
                'file.view',
                ['type' => FileViewAction::TYPE_AVATAR, 'uuid' => $this->avatar->uuid]
            ) : null,
            'post_summary' => Post::where('user_id', $this->user_id)->count(),
            'registered_at' => $this->registered_at,
        ];
    }
}
