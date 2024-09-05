<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller\Resource;

use App\Http\Controllers\FileViewAction;
use Illuminate\Http\Resources\Json\JsonResource;

class TrashResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->serviceUser->user_id,
            'store_name' => $this->store_name,
            'comment' => !is_null($this->store_name) ? $this->comment : null,
            'slug' => $this->slug,
            'post_img' => route(
                'file.view',
                ['type' => FileViewAction::TYPE_POST_IMG, 'uuid' => $this->postImg->uuid]
            ),
            'posted_at' => $this->posted_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
