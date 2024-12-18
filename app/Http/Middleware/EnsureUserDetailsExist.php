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

        if ($user->isAdmin()) {
            return $next($request);
        }
         if (!$user->userDetails) {

            return redirect()->route('edit-profile',['record'=> $user])
                ->with('warning', 'Please complete your user details.');
        }



        return $next($request);
    }
}
