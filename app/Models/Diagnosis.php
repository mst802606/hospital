<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        # code...
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        # code...
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function visit()
    {
        # code...
        return $this->belongsTo(Visits::class, 'visit_id');
    }
}
