<?php

namespace RobYpz\MongoRole\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string ...$roles): Response
    {
        if (!$request->user()->hasPermission($roles)) {
            return response(['message' => 'You dont have any permission'], 403);
        }
        return $next($request);
    }
}
