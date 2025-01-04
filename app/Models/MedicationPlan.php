<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'medication_medication_plans');
    }

}
