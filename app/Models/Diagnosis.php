<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patients()
    {
        # code...
        return $this->belongsToMany(Patient::class, 'diagnosis_patients');
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
