<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserDetailsExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && !$user->userDetails && $user->role != 'admin') {
            // Redirect to the user details form if UserDetails is missing
            return redirect()->route('user.createUserDetails')
                             ->with('warning', 'Please complete your user details.');
        }

        return $next($request);
    }
}
