<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            // Not logged in, redirect to login
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles)) {
            // Logged in but unauthorized, redirect to appropriate page
            if ($user->role === 'admin') {
                return redirect()->route('admin-dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            if ($user->role === 'customer') {
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            // Fallback for undefined roles
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
