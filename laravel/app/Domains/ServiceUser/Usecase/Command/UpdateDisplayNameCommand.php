<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class UpdateDisplayNameCommand
{
    private string $displayName;

    /**
     * @param string $displayName
     */
    public function __construct(
        string $displayName,
    ) {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }
}
