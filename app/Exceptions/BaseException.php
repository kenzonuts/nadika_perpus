<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseException extends Exception
{
    protected int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    protected string $errorCode = 'INTERNAL_ERROR';

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * @return array<string, mixed>
     */
    public function getContext(): array
    {
        return [];
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'error_code' => $this->getErrorCode(),
            'errors' => $this->getContext(),
        ], $this->getStatusCode());
    }
}
