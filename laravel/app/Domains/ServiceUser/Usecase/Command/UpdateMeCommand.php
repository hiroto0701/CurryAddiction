<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class UpdateMeCommand
{
    private string $displayName;

    /**
     * @param string $nameKana
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
