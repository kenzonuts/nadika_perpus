<?php

declare(strict_types=1);

namespace App\Traits;

use App\Support\ApiResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponds
{
    /**
     * @param  array<string, mixed>|null  $data
     */
    protected function successResponse(
        ?array $data = null,
        string $message = 'Success',
        int $statusCode = Response::HTTP_OK,
    ): JsonResponse {
        return ApiResponse::success($data, $message, $statusCode);
    }

    /**
     * @param  array<string, mixed>|null  $errors
     */
    protected function errorResponse(
        string $message,
        int $statusCode = Response::HTTP_BAD_REQUEST,
        ?string $errorCode = null,
        ?array $errors = null,
    ): JsonResponse {
        return ApiResponse::error($message, $statusCode, $errorCode, $errors);
    }

    /**
     * @param  array<string, mixed>|null  $data
     */
    protected function createdResponse(?array $data = null, string $message = 'Created successfully'): JsonResponse
    {
        return ApiResponse::created($data, $message);
    }

    protected function noContentResponse(): JsonResponse
    {
        return ApiResponse::noContent();
    }

    /**
     * @param  LengthAwarePaginator<int, mixed>  $paginator
     */
    protected function paginatedResponse(
        LengthAwarePaginator $paginator,
        string $message = 'Success',
    ): JsonResponse {
        return ApiResponse::paginated($paginator, $message);
    }
}
