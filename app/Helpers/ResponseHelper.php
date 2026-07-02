<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ResponseHelper
{
    /**
     * @param  array<string, mixed>|null  $data
     */
    public static function success(
        ?array $data = null,
        string $message = 'Success',
        int $statusCode = Response::HTTP_OK,
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * @param  array<string, mixed>|null  $errors
     */
    public static function error(
        string $message = 'An error occurred',
        int $statusCode = Response::HTTP_BAD_REQUEST,
        ?string $errorCode = null,
        ?array $errors = null,
    ): JsonResponse {
        $payload = [
            'success' => false,
            'message' => $message,
        ];

        if ($errorCode !== null) {
            $payload['error_code'] = $errorCode;
        }

        if ($errors !== null) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $statusCode);
    }

    /**
     * @param  LengthAwarePaginator<int, mixed>  $paginator
     */
    public static function paginated(
        LengthAwarePaginator $paginator,
        string $message = 'Success',
        int $statusCode = Response::HTTP_OK,
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ], $statusCode);
    }
}
