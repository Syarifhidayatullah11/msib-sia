<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAkses
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check()) {
            $userRole = auth()->user()->role_id;

            if ($userRole == 1 && $role == '1') {
                return $next($request);
            } elseif ($userRole == 2 && $role == '2') {
                return $next($request);
            }
        }

        abort(403, 'Akses ditolak.');
    }
}