<?php

namespace App\Domains\Post\Usecase\Command;

class IndexCommand
{
    private ?int $page;
    private ?int $perPage;
    private ?string $sortAttribute;
    private ?string $sortDirection;

    public function __construct(
        ?int $page,
        ?int $perPage,
        ?string $sortAttribute,
        ?string $sortDirection,
    ) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->sortAttribute = $sortAttribute;
        $this->sortDirection = $sortDirection;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @return string|null
     */
    public function getSortAttribute(): ?string
    {
        return $this->sortAttribute;
    }

    /**
     * @return string|null
     */
    public function getSortDirection(): ?string
    {
        return $this->sortDirection;
    }
}
