<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patients()
    {
        # code...
       return $this->belongsTo(Patient::class,'patient_id');
    }

    public function hospital()
    {
        # code...
       return $this->belongsTo(Hospital::class,'hospital_id');
    }

    public function doctor()
    {
        # code...
       return $this->belongsTo(Doctor::class,'doctor_id');
    }



}
