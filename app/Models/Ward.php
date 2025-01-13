<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hospital()
    {
        return $this->hasMany(Hospital::class, 'hospital_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'ward_id');
    }

    public function nurses()
    {
        return $this->belongsToMany(Nurse::class, 'nurses_wards');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'ward_id');
    }

}
