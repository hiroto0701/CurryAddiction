<?php

declare(strict_types=1);

namespace App\Domains\Genre\Usecase;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class IndexInteractor
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function handle(): Collection
    {
        return Genre::all();
    }
}
