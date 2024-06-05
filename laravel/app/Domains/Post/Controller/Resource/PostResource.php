<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Resource;

use App\Http\Controllers\FileViewAction;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'genre_id' => $this->genre_id,
            'region_id' => $this->region_id,
            'prefecture_id' => $this->prefecture_id,
            'store_name' => $this->store_name,
            'comment' => !is_null($this->store_name) ? $this->comment : null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'post_img' => route(
                'file.view',
                ['type' => FileViewAction::TYPE_POST_IMG, 'uuid' => $this->postImg->uuid]
            ),
            'posted_at' => $this->posted_at,
        ];
    }
}
