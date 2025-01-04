<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class Appointments extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function visit()
    {
        # code...
        $this->hasMany(Visits::class, 'appointment_id');
    }

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
}
