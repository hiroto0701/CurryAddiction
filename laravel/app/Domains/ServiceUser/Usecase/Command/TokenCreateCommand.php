<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class TokenCreateCommand
{
    private string $email;
    private string $onetime_token;

    public function __construct(
        string $email,
        string $onetime_token,
    ) {
        $this->email = $email;
        $this->onetime_token = $onetime_token;
    }

    /**
     * @return int
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getOnetimeToken(): string
    {
        return $this->onetime_token;
    }
}
