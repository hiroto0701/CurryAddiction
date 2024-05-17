<?php

namespace App\Domains\TwoStepAuthentication\Usecase\Command;

class CreateCommand
{
    // private int $userId;
    // private string $token;

    // public function __construct(
    //     int $user_id,
    //     string $token,
    // ) {
    //     $this->userId = $user_id;
    //     $this->token = $token;
    // }

    // /**
    //  * @return int
    //  */
    // public function getUserId()
    // {
    //     return $this->userId;
    // }

    // /**
    //  * @return string
    //  */
    // public function getToken(): string
    // {
    //     return $this->token;
    // }



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
