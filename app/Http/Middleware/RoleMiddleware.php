<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login
        if (!$request->user()) {
            abort(403, 'Anda belum login');
        }

        // Mendukung multiple roles, misalnya: 'admin|petugas'
        $allowed = explode('|', $role);
        if (! in_array($request->user()->role, $allowed)) {
            abort(403, 'Anda tidak memiliki akses');
        }

        return $next($request);
    }
}
