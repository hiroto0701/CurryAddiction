<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Analytics\Controller\Resource;

use App\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalyticsCollection extends ResourceCollection
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
