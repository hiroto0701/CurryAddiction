<?php

namespace App\Domains\Dashboard\Analytics\Usecase\Command;

class IndexCommand
{
    private int $userId;
    private ?string $sortAttribute;
    private ?string $sortDirection;

    public function __construct(
        int     $userId,
        ?string $sortAttribute,
        ?string $sortDirection,
    ) {
        $this->userId = $userId;
        $this->sortAttribute = $sortAttribute;
        $this->sortDirection = $sortDirection;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
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
