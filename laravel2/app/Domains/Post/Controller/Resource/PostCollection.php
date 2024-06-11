<?php

declare(strict_types=1);

namespace App\Domains\Post\Controller\Resource;

use App\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostCollection extends ResourceCollection
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
