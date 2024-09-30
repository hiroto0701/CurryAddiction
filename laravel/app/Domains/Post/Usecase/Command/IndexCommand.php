<?php

namespace App\Domains\Post\Usecase\Command;

class IndexCommand
{
    private ?string $userId;
    private ?int $page;
    private ?int $perPage;
    private ?bool $isLiked;
    private ?bool $isArchived;
    private array $favoriteGenres;
    private ?string $sortAttribute;
    private ?string $sortDirection;

    public function __construct(
        ?string $userId,
        ?int $page,
        ?int $perPage,
        ?bool $isLiked,
        ?bool $isArchived,
        array $favoriteGenres = [],

        ?string $sortAttribute,
        ?string $sortDirection,
    ) {
        $this->userId = $userId;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->isLiked = $isLiked;
        $this->isArchived = $isArchived;
        $this->favoriteGenres = $favoriteGenres;
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
     * @return bool|null
     */
    public function getIsLiked(): ?bool
    {
        return $this->isLiked;
    }

    /**
     * @return bool|null
     */
    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    /**
     * @return array
     */
    public function getFavoriteGenres(): array
    {
        return $this->favoriteGenres;
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
