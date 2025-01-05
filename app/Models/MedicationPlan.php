<?php

namespace App\Models;

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

}
