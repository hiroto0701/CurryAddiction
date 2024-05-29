<?php

declare(strict_types=1);

namespace App\Exceptions;
use Exception;

use Symfony\Component\HttpFoundation\Response;

class UserStatusException extends Exception
{
    private ?string $status;

    public function __construct($message = 'ユーザーのステータスが無効です。', $code = Response::HTTP_UNAUTHORIZED, Exception $previous = null, $status = null,)
    {
        parent::__construct($message, $code, $previous);
        $this->status = $status;
    }

    public function render(): Response
    {
        return response()->json([
            'message' => $this->getMessage(),
            'status' => $this->status,
        ], $this->getCode());
    }
}
