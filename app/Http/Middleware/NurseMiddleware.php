<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NurseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 3 && auth()->user()->nurse) {

            return $next($request);

        } else {

            return abort(500, 'You are not registered as a Nurse')->with('error', 'You are not registered as a Nurse');
        }

    }
}
