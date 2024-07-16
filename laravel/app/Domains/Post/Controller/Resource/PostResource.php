<?php
declare(strict_types=1);

namespace App\Domains\Post\Controller\Resource;

use App\Http\Controllers\FileViewAction;
use App\Models\ServiceUser;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'genre_id' => $this->genre_id,
            'store_name' => $this->store_name,
            'comment' => !is_null($this->store_name) ? $this->comment : null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'post_img' => route(
                'file.view',
                ['type' => FileViewAction::TYPE_POST_IMG, 'uuid' => $this->postImg->uuid]
            ),
            'liked_count' => $this->likes()->count(),
            'posted_at' => $this->posted_at,
            'posted_by' => $this->user_id,
            'user' => [
                'user_id' => $this->serviceUser->user_id,
                'display_name' => $this->serviceUser->display_name,
                'handle_name' => $this->serviceUser->handle_name,
                'avatar_url' => $this->serviceUser->avatar ? route(
                    'file.view',
                    ['type' => FileViewAction::TYPE_AVATAR, 'uuid' => $this->serviceUser->avatar->uuid]
                ) : null,
            ],
            'is_mine' => User::AuthId() === $this->serviceUser->user_id,
            "current_user_liked" => $this->likes->isNotEmpty(),
            "current_user_archived" => false,
        ];
    }
}
