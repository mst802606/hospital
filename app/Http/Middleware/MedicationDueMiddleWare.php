<?php
namespace App\Http\Middleware;

use App\Models\MedicationPlan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicationDueMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user role is 3 for a nurse
        if (auth()->user()->role == 3) {
            auth()->user()->notifications->markAsRead();
            $mediaction_needed = MedicationPlan::checkDueMedications();
            if ($mediaction_needed) {

                session()->flash('error', 'Some patients require medications. Check your notifications');
            }

        }

        // Continue the request cycle
        return $next($request);

    }
}
