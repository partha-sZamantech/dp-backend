<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role
     * @return mixed
     *
     * 1 => Power Admin, 2 => News Admin, 3 => Adv Admin, 4 => Cat Admin, 5 => EN News Admin
     *
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Access Denied');
        }
        return $next($request);
    }
}
