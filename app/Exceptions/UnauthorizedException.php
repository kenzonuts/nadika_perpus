<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends BaseException
{
    protected int $statusCode = Response::HTTP_FORBIDDEN;

    protected string $errorCode = 'UNAUTHORIZED';

    public function __construct(
        string $message = 'You are not authorized to perform this action.',
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, 0, $previous);
    }
}
