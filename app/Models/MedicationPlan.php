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
        return $this->belongsToMany(Medication::class, 'medication_medication_plans')->withPivot(
            "nurse_id",
            "doctor_id",
            "recommendation_notes",
            "status",
        );
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
        $patients          = self::where('is_active', true)
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

                    $pivot->last_given = Carbon::parse($pivot->last_given);
                    // Morning medication (6 AM - 9 AM)

                    if ($medication->amount_taken_morning > 0 && ! $pivot->amount_taken_morning
                        && ! ($pivot->last_given->between(Carbon::today(env('timezone'))->setTime(6, 30),
                            Carbon::today(env('timezone'))->setTime(11, 59)))
                    ) {

                        $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(6, 30);
                         $patient->save();

                        if ($now->between(Carbon::today(env('timezone'))->setTime(6, 30),
                            Carbon::today(env('timezone'))->setTime(11, 59))) {$mediaction_needed = true;
                            Nurse::notifyNursesOnMedication($patient, "Morning medication needed");
                            $patient->medication_given       = false;
                            $patient->save();
                        }
                    }

                    // Noon medication (12 PM - 1 PM)
                    if ($medication->amount_taken_noon > 0 && ! $pivot->amount_taken_noon
                        && ! ($pivot->last_given->between(Carbon::today(env('timezone'))->setTime(12, 0),
                            Carbon::today(env('timezone'))->setTime(17, 59)))

                    ) {
                        $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(12, 0);
                         $patient->save();

                        if ($now->between(Carbon::today(env('timezone'))->setTime(12, 0),
                            Carbon::today(env('timezone'))->setTime(17, 59))) {$mediaction_needed = true;
                            Nurse::notifyNursesOnMedication($patient, "Noon medication needed");
                            $patient->medication_given       = false;
                            $patient->save();
                        }
                    }

                    // Evening medication (2:30 PM - 7 PM)
                    if ($medication->amount_taken_evening > 0 && ! $pivot->amount_taken_evening
                        && ! ($pivot->last_given->between(Carbon::today(env('timezone'))->setTime(18, 0),
                            Carbon::today(env('timezone'))->setTime(20, 59)))
                    ) {
                        $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(18, 0);
                        $patient->save();

                        if ($now->between(Carbon::today(env('timezone'))->setTime(18, 0),
                            Carbon::today(env('timezone'))->setTime(20, 59))) {$mediaction_needed = true;
                            Nurse::notifyNursesOnMedication($patient, "Evening medication needed");
                            $patient->medication_given       = false;
                            $patient->save();
                        }

                    }

                    // Night medication (9 PM - 10 PM)
                    if ($medication->amount_taken_night > 0 && ! $pivot->amount_taken_night &&
                        ! ($pivot->last_given->between(Carbon::today(env('timezone'))->setTime(21, 0), Carbon::today(env('timezone'))->setTime(22, 30)))
                    ) {

                        $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(21, 0);
                        $patient->save();
                        if ($now->between(Carbon::today(env('timezone'))->setTime(21, 0),
                            Carbon::today(env('timezone'))->setTime(22, 30))) {$mediaction_needed = true;
                            Nurse::notifyNursesOnMedication($patient, "Night medication needed");
                            $patient->medication_given       = false;
                            $patient->save();
                        }
                    }
                }
            } else {

                foreach ($patient->medicationPlans as $medication_plan) {
                    foreach ($medication_plan->medications as $medication) {
                        $mediaction_needed = false;

                        if (
                            $medication->amount_taken_morning > 0
                        ) {

                            if ($now->between(Carbon::today(env('timezone'))->setTime(6, 30), Carbon::today(env('timezone'))->setTime(11, 59))) {$mediaction_needed = true;
                                Nurse::notifyNursesOnMedication($patient, "Morning medication needed");
                                $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(6, 30);
                                $patient->medication_given       = false;
                                $patient->save();}

                        }

                        // Noon medication (12 PM - 1 PM)
                        if (
                            $medication->amount_taken_noon > 0

                        ) {

                            if ($now->between(Carbon::today(env('timezone'))->setTime(12, 0), Carbon::today(env('timezone'))->setTime(17, 59))) {$mediaction_needed = true;
                                Nurse::notifyNursesOnMedication($patient, "Noon medication needed");
                                $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(12, 0);
                                $patient->medication_given       = false;
                                $patient->save();}
                        }

                        // Evening medication (2:30 PM - 7 PM)
                        if (
                            $medication->amount_taken_evening > 0

                        ) {

                            ;

                            if ($now->between(Carbon::today(env('timezone'))->setTime(18, 0), Carbon::today(env('timezone'))->setTime(20, 59))) {$mediaction_needed = true;
                                Nurse::notifyNursesOnMedication($patient, "Evening medication needed");
                                $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(12, 0);
                                $patient->medication_given       = false;
                                $patient->save();}

                        }

                        // Night medication (9 PM - 10 PM)
                        if (
                            $medication->amount_taken_night > 0

                        ) {
                            if ($now->between(Carbon::today(env('timezone'))->setTime(21, 0), Carbon::today(env('timezone'))->setTime(22, 30))) {$mediaction_needed = true;
                                Nurse::notifyNursesOnMedication($patient, "Night medication needed");
                                $patient->medication_required_at = Carbon::today(env('timezone'))->setTime(12, 0);
                                $patient->medication_given       = false;
                                $patient->save();}
                        }
                    }

                }
            }
        }

        return $mediaction_needed;
    }

}
