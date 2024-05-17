<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class TokenCreateCommand
{
    private string $email;
    private string $token;

    public function __construct(
        string $email,
        string $token,
    ) {
        $this->email = $email;
        $this->token = $token;
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
    public function getToken(): string
    {
        return $this->token;
    }
}
