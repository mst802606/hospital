<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function medicationPlans()
    {
        return $this->belongsToMany(MedicationPlan::class, 'medication_medication_plans')
        ->withPivot(
            "nurse_id",
"doctor_id",
"recommendation_notes",
"status",
        );
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'medications_patients')->withPivot(
            "nurse_id",
            "doctor_id",
            "amount_taken_morning",
            "amount_taken_noon",
            "amount_taken_evening",
            "amount_taken_night",
            "total_amount_given",
            "recommendation_notes",
            "last_given",
            "status",
        );
    }

}
