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

    public function diagnosis()
    {
        # code...
        return $this->belongsToMany(Diagnosis::class, 'diagnosis_patients');
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

    public function medicationPlans()
    {
        return $this->hasMany(PatientMedicationPlan::class);
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'medication_patients');
    }
}
