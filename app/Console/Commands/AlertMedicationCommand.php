<?php

namespace App\Console\Commands;

use App\Models\MedicationPlan;
use App\Models\Patient;
use App\Notifications\MedicationDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AlertMedicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:medication-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alerts nurses on medications that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $patients = MedicationPlan::where('is_active', true)
            ->with('patients')
            ->get()
            ->pluck('patients')
            ->flatten(); // Flatten if each MedicationPlan has multiple patients

        foreach ($patients as $patient) {
            $medications_in_progress = $patient->medications()
                ->with(['patients' => function ($query) use ($patient) {
                    $query->withPivot(
                        'last_given',
                        'amount_taken_morning',
                        'amount_taken_noon',
                        'amount_taken_evening',
                        'amount_taken_night',
                        'total_amount_given'
                    )->where('medications_patients.patient_id', $patient->id)
                        ->whereDate('medications_patients.created_at', today());
                }])
                ->get();

            if ($medications_in_progress->has('patients')) {
                foreach ($medications_in_progress->patients as $patient) {
                    // Get the pivot data for this patient
                    $pivot = $patient->pivot;

                    // Get the current date and time
                    $now = Carbon::now();

                    // Check for morning medication (e.g., 6 AM to 9 AM)
                    if ($pivot->amount_taken_morning > 0 &&
                        $now->between(Carbon::today()->setTime(6, 0), Carbon::today()->setTime(9, 0)) &&
                        Carbon::parse($pivot->last_given)->isBefore($now)) {
                        // It's past the morning medication time
                        // Add your logic here
                        $this->notifyNurses($patient);
                    }

                    // Check for noon medication (e.g., 12 PM to 1 PM)
                    if ($pivot->amount_taken_noon > 0 &&
                        $now->between(Carbon::today()->setTime(12, 0), Carbon::today()->setTime(13, 0)) &&
                        Carbon::parse($pivot->last_given)->isBefore($now)) {
                        // It's past the noon medication time
                        // Add your logic here
                        $this->notifyNurses($patient);
                    }

                    // Check for evening medication (e.g., 6 PM to 7 PM)
                    if ($pivot->amount_taken_evening > 0 &&
                        $now->between(Carbon::today()->setTime(18, 0), Carbon::today()->setTime(19, 0)) &&
                        Carbon::parse($pivot->last_given)->isBefore($now)) {
                        // It's past the evening medication time
                        // Add your logic here
                        $this->notifyNurses($patient);
                    }

                    // Check for night medication (e.g., 9 PM to 10 PM)
                    if ($pivot->amount_taken_night > 0 &&
                        $now->between(Carbon::today()->setTime(21, 0), Carbon::today()->setTime(22, 0)) &&
                        Carbon::parse($pivot->last_given)->isBefore($now)) {
                        // It's past the night medication time
                        // Add your logic here
                        $this->notifyNurses($patient);
                    }

                    // Check for the maximum amount per day (if needed)
                    if ($pivot->maximum_amount_per_day > $pivot->total_amount_given &&
                        Carbon::parse($pivot->last_given)->isBefore($now)) {
                        // It's past the maximum medication time for the day
                        // Add your logic here
                        $this->notifyNurses($patient);
                    }
                }
            } else {
                $this->notifyNurses($patient);
            }
        }

    }

    private function notifyNurses(Patient $patient)
    {

        $nurses = $patient->ward->nurses;

        foreach ($nurses as $nurse) {
            $nurse->user->notify(new MedicationDueNotification($patient, $patient->ward));
        }
    }
}
