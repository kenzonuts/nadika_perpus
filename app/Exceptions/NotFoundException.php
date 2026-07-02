<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends BaseException
{
    protected int $statusCode = Response::HTTP_NOT_FOUND;

    protected string $errorCode = 'NOT_FOUND';

    public function __construct(
        string $message = 'The requested resource was not found.',
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, 0, $previous);
    }
}
