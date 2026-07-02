<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class LibraryException extends BaseException
{
    protected int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    protected string $errorCode = 'LIBRARY_ERROR';

    /**
     * @param  array<string, mixed>  $context
     */
    public function __construct(
        string $message = 'A library operation failed.',
        protected array $context = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, 0, $previous);
    }

    /**
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
