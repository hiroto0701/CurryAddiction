<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthenticationTokenException extends Exception
{
    private bool $unmatched;
    private bool $expired;

    public function __construct($message = 'Authentication token error.', $code = Response::HTTP_UNAUTHORIZED, Throwable $previous = null, $unmatched = false, $expired = false)
    {
        $this->unmatched = $unmatched;
        $this->expired = $expired;
        parent::__construct($message, $code, $previous);
    }

    public function render(): Response
    {
        return response()->json([
            'message' => $this->getMessage(),
            'is_unmatched' => $this->unmatched,
            'is_expired' => $this->expired,
        ], $this->getCode());
    }
}
