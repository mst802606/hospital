<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicationPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function plan()
    {
        return $this->belongsTo(MedicationPlan::class);
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

}
