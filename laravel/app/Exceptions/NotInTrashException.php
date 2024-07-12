<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class NotInTrashException extends Exception
{
    public function __construct($message = 'The post is not in the trash.', $code = Response::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null)
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
