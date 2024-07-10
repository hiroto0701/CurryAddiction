<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Trash\Controller\Resource;

use App\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TrashCollection extends ResourceCollection
{
    /**
     * @param Request $request
     *
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}
