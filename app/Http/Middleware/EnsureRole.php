<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $role = $request->session()->get('role');

        if ($role && in_array($role, $roles, true)) {
            return $next($request);
        }

        if ($role === 'sales') {
            return redirect()->route('sales.create');
        }

        if ($role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
