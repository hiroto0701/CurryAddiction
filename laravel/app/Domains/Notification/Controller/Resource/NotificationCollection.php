<?php

declare(strict_types=1);

namespace App\Domains\Notification\Controller\Resource;

use App\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class NotificationCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'meta' => $this->getCustomMeta(),
        ];
    }

    // 次のページがあるかどうかをmeta情報に付与
    /**
     * @return array
     */
    protected function getCustomMeta(): array
    {
        return [
            'has_more_pages' => $this->hasMorePages(),
            'next_page' => $this->hasMorePages() ? $this->currentPage() + 1 : null
        ];
    }
}
