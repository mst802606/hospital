<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 2 && auth()->user()->doctor) {

            return $next($request);

        } else {

            return abort(500, 'You are not registered as a Doctor')->with('error', 'You are not registered as a Doctor');
        }
    }
}
