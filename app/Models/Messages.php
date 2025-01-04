<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $guarded = [];

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
    public function user()
    {
        # code...
       return $this->belongsTo(User::class, 'user_id');
    }
}
