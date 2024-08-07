<?php

namespace App\Domains\Dashboard\Trash\Usecase\Command;

class IndexCommand
{
    private ?string $userId;
    private ?int $page;
    private ?int $perPage;
    private ?string $sortAttribute;
    private ?string $sortDirection;

    public function __construct(
        ?string $userId,
        ?int $page,
        ?int $perPage,
        ?string $sortAttribute,
        ?string $sortDirection,
    ) {
        $this->userId = $userId;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->sortAttribute = $sortAttribute;
        $this->sortDirection = $sortDirection;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
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
