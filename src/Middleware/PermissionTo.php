<?php

namespace RobYpz\MongoRole\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionTo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$permission): Response
    {
        if (!$request->user()->hasPermissionTo($permission)) {
            return response(['message' => 'You dont have permission'], 403);
        }

        return $next($request);
    }
}
