<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user is active
        if (!$user->is_active) {
            Auth::logout();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['error' => 'Akun Anda tidak aktif. Silakan hubungi administrator.'], 403);
            }
            return redirect()->route('login')->with('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
        }

        // Check if user has any of the required roles
        if (!empty($roles)) {
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return $next($request);
                }
            }
            
            // If user doesn't have required role, handle based on request type
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['error' => 'Akses ditolak. Anda tidak memiliki izin untuk mengakses resource ini.'], 403);
            }
            
            // Redirect based on their role for non-AJAX requests
            if ($user->hasRole('admin') || $user->hasRole('super-admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('staff')) {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
