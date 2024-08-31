<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAccout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $role = $user->role->nama;
        if ($user->status_verifikasi == 'terverifikasi') return redirect()->route("$role.dashboard");
        foreach ($guards as $guard) {
            if ($guard == 'process' && $user->status_verifikasi == 'proses') return $next($request);
            elseif ($guard == 'reject' && $user->status_verifikasi == 'ditolak') return $next($request);
            elseif ($guard == 'process' && $user->status_verifikasi == 'ditolak') return redirect()->route('auth.reject.verification');
            elseif ($guard == 'reject' && $user->status_verifikasi == 'proses') return redirect()->route('auth.wait.verification');
        }
        // return $next($request);
    }
}
