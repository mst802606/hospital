<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
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
        return $this->hasMany(Appointments::class, 'doctor_id');
    }

    public function hospital()
    {
        # code...
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function visits()
    {
        # code...
        return $this->hasMany(Visits::class, 'doctor_id');
    }

    public function diagnosis()
    {
        # code...
        return $this->hasMany(Diagnosis::class, 'doctor_id');
    }

    public function messages()
    {
        # code...
        return $this->hasMany(Messages::class, 'doctor_id');
    }

    public function patients()
    {
        # code...
        return $this->belongsToMany(Patient::class, 'doctor_patient');
    }

    public function donations()
    {
        # code...
        return $this->hasMany(Donation::class, 'doctor_id');
    }
}
