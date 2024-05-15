<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthenticationTokenException extends Exception
{
    private bool $required;
    private bool $unmatched;

    public function __construct($message = 'Authentication token error.', $code = Response::HTTP_UNAUTHORIZED, Throwable $previous = null,
        $required = false, $unmatched = false)
    {
        $this->required = $required;
        $this->unmatched = $unmatched;
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        // Errorログは残さない
    }

    public function render(): Response
    {
        return response()->json([
            'message' => $this->getMessage(),
            'is_required' => $this->required,
            'is_unmatched' => $this->unmatched,
        ], $this->getCode());
    }
}
