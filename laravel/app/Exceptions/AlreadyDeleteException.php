<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AlreadyDeletedException extends Exception
{
    public function __construct($message = 'Resource is already deleted.', $code = Response::HTTP_GONE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): Response
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
