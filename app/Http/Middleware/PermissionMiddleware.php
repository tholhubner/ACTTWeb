<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null, $guard = null)
    {
        $auth_guard = app('auth')->guard($guard);

        if ($auth_guard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (!is_null($permission)) {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }

        if (is_null($permission)) {
            $permission = $request->route()->getName();
            $permissions = array($permission);
        }

        foreach ($permissions as $permission) {
            if ($auth_guard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
