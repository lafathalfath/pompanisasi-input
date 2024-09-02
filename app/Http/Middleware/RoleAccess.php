<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (empty($guards)) return abort(500);
        
        foreach ($guards as $guard) {
            $user = Auth::user();
            $role = $user->role->nama;
            if ($user->status_verifikasi == 'proses') return redirect()->route('auth.wait.verification');
            elseif ($user->status_verifikasi == 'ditolak') return redirect()->route('auth.reject.verification');
            if ($role == $guard) {
                return $next($request);
            }
            return redirect()->route("$role.dashboard");
        }
    }
}
