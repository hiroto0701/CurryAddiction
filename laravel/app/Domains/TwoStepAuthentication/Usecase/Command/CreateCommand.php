<?php

namespace App\Domains\TwoStepAuthentication\Usecase\Command;

class CreateCommand
{
    private int $userId;
    private string $token;

    public function __construct(
        int $user_id,
        string $token,
    ) {
        $this->userId = $user_id;
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
