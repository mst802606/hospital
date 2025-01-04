<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function appointment()
    {
        # code...
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }

    public function doctor()
    {
        # code...
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient()
    {
        # code...
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function hospital()
    {
        # code...
        return $this->belongsTo(Hospital::class, 'hopsital_id');
    }

    public function diagnosis()
    {
        # code...
        return $this->hasMany(Diagnosis::class, 'visit_id');
    }
}
