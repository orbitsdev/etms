<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRequestIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->route('requestId');

        $record = RequestModel::find($requestId);

        if (!$record || $record->status !== 'Completed') {
            abort(403, 'This request is not marked as completed.');
        }

        return $next($request);
    }
}
