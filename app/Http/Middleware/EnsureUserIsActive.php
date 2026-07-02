<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user instanceof User && property_exists($user, 'is_active') && $user->is_active === false) {
            throw new UnauthorizedException('Your account has been deactivated.');
        }

        if ($user instanceof User && method_exists($user, 'trashed') && $user->trashed()) {
            throw new UnauthorizedException('Your account is no longer available.');
        }

        return $next($request);
    }
}
