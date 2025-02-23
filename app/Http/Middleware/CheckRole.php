<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!$request->user()) {
            return response()->json(['message' => 'Login dlu bre'], 401);
        }

        // Split roles jika ada multiple roles (admin,coach)
        $rolesArray = array_map('trim', $roles);

        // Cek apakah user memiliki salah satu dari role yang diizinkan
        if (!$request->user()->roles()->whereIn('name', $rolesArray)->exists()) {
            return response()->json(['message' => 'Kamu bukan admin bre '], 403);
        }

        return $next($request);
    }
}
