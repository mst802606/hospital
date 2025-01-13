<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'medication_medication_plans');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_medication_plans')
            ->as('allocated_plans')
            ->withPivot("medication_plan_id", "patient_id", "nurse_id", "doctor_id", "recommendation_notes", "status", )
            ->withTimestamps();
    }

    public static function checkDueMedications()
    {

        $mediaction_needed = false;
        $patients = self::where('is_active', true)
            ->with('patients')
            ->get()
            ->pluck('patients')
            ->flatten();

        foreach ($patients as $patient) {
            $medications_in_progress = $patient->medications()
                ->with('medicationPlans')
                ->whereDate('medications_patients.created_at', Carbon::today(env('timezone')))
                ->get();

            $now = Carbon::now(env('timezone'));

            if ($medications_in_progress->isNotEmpty()) {
                foreach ($medications_in_progress as $medication) {
                    $pivot = $medication->pivot;

                    // Morning medication (6 AM - 9 AM)

                    if ($medication->amount_taken_morning > 0 && !$pivot->amount_taken_morning &&
                        $now->between(Carbon::today(env('timezone'))->setTime(6, 30), Carbon::today(env('timezone'))->setTime(9, 30))
                    ) {
                        $mediaction_needed = true;
                        Nurse::notifyNursesOnMedication($patient, "Morning medication needed");
                    }

                    // Noon medication (12 PM - 1 PM)
                    if ($medication->amount_taken_noon > 0 && !$pivot->amount_taken_noon &&
                        $now->between(Carbon::today(env('timezone'))->setTime(12, 0), Carbon::today(env('timezone'))->setTime(13, 30))
                    ) {
                        $mediaction_needed = true;
                        Nurse::notifyNursesOnMedication($patient, "Noon medication needed");
                    }

                    // Evening medication (2:30 PM - 7 PM)
                    if ($medication->amount_taken_evening > 0 && !$pivot->amount_taken_evening &&
                        $now->between(Carbon::today(env('timezone'))->setTime(18, 0), Carbon::today(env('timezone'))->setTime(19, 30))
                    ) {

                        $mediaction_needed = true;
                        Nurse::notifyNursesOnMedication($patient, "Evening medication needed");

                    }

                    // Night medication (9 PM - 10 PM)
                    if ($medication->amount_taken_night > 0 && !$pivot->amount_taken_night &&
                        $now->between(Carbon::today(env('timezone'))->setTime(21, 0), Carbon::today(env('timezone'))->setTime(22, 30))
                    ) {

                        $mediaction_needed = true;
                        Nurse::notifyNursesOnMedication($patient, "Night medication needed");
                    }
                }
            } else {
                $mediaction_needed = false;

                // dd($now);
                if (
                    $now->between(Carbon::today(env('timezone'))->setTime(6, 30), Carbon::today(env('timezone'))->setTime(9, 30))
                ) {
                    $mediaction_needed = true;
                    Nurse::notifyNursesOnMedication($patient, "Morning medication needed");

                }

                // Noon medication (12 PM - 1 PM)
                if (
                    $now->between(Carbon::today(env('timezone'))->setTime(12, 0), Carbon::today(env('timezone'))->setTime(13, 30))
                ) {
                    $mediaction_needed = true;
                    Nurse::notifyNursesOnMedication($patient, "Noon medication needed");
                }

                // Evening medication (2:30 PM - 7 PM)
                if (
                    $now->between(Carbon::today(env('timezone'))->setTime(18, 0), Carbon::today(env('timezone'))->setTime(19, 30))
                ) {

                    $mediaction_needed = true;
                    Nurse::notifyNursesOnMedication($patient, "Evening medication needed");

                }

                // Night medication (9 PM - 10 PM)
                if (
                    $now->between(Carbon::today(env('timezone'))->setTime(21, 0), Carbon::today(env('timezone'))->setTime(22, 30))
                ) {

                    $mediaction_needed = true;
                    Nurse::notifyNursesOnMedication($patient, "Night medication needed");
                }

                // Nurse::notifyNursesOnMedication($patient);
            }
        }

        return $mediaction_needed;
    }

}
