<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id');
    }
    public function appointments()
    {
        # code...
        return $this->hasMany(Appointments::class, 'patient_id');
    }

    public function hospital()
    {
        # code...
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function visits()
    {
        # code...
        return $this->hasMany(Visits::class, 'patient_id');
    }

    public function diagnoses()
    {
        # code...
        return $this->hasMany(Diagnosis::class, 'patient_id');
    }

    public function messages()
    {
        # code...
        return $this->hasMany(Messages::class, 'patient_id');
    }

    public function donations()
    {
        # code...
        return $this->hasMany(Donation::class, 'patient_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function nurses()
    {
        return $this->belongsToMany(Nurse::class, 'nurse_patient');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'patient_id');
    }

    public function medicationPlans()
    {
        return $this->belongsToMany(MedicationPlan::class, 'patient_medication_plans')
            ->as('allocated_plans')
            ->withPivot("medication_plan_id", "patient_id", "nurse_id", "doctor_id", "recommendation_notes", "status", )
            ->withTimestamps();
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'medications_patients')->withPivot(
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
