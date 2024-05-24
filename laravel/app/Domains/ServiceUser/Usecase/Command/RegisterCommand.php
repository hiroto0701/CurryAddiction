<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class RegisterCommand
{
    private string $email;
    private string $handleName;

    /**
     * @param string $email
     * @param string $handleName
     */
    public function __construct(
        string $email,
        string $handleName,
    ) {
        $this->email = $email;
        $this->handleName = $handleName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getHandleName(): string
    {
        return $this->handleName;
    }
}
