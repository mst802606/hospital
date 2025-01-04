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
        return $this->belongsToMany(MedicationPlan::class, 'medication_medication_plans');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'medication_patients');
    }

}
