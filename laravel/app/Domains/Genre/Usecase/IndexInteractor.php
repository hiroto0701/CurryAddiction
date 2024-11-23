<?php

declare(strict_types=1);

namespace App\Domains\Genre\Usecase;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class IndexInteractor
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function handle(): Collection {
        return Cache::remember('genres_all', now()->addHours(24), function () {
            return Genre::all();
        });
    }
}
