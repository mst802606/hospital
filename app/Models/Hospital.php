<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function wards()
    {
        # code...
        return $this->hasMany(Ward::class, 'hospital_id');
    }

    public function nurses()
    {
        # code...
        return $this->hasMany(Nurse::class, 'hospital_id');
    }

    public function patients()
    {
        # code...
        return $this->hasMany(Patient::class, 'hospital_id');
    }

    public function doctors()
    {
        # code...
        return $this->hasMany(Doctor::class, 'hospital_id');
    }

    public function visits()
    {
        # code...
        return $this->hasMany(Visits::class, 'hospital_id');
    }

    public function donations()
    {
        # code...
        return $this->hasMany(Donation::class, 'hospital_id');
    }
}
