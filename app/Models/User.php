<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phoneno',
        'terms_and_conditions',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile()
    {
        # code...
        return $this->hasOne(Profile::class, 'user_id');
    }
    public function nurse()
    {
        # code...
        return $this->hasOne(Nurse::class, 'user_id');
    }

    public function hospital()
    {
        # code...
        return $this->hasOne(Hospital::class, 'hospital_id');
    }

    public function doctor()
    {
        # code...
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function patient()
    {
        # code...
        return $this->hasOne(Patient::class, 'user_id');
    }

    public function recommendations()
    {
        return $this->hasMany(PatientMedicationPlan::class, 'nurse_id');
    }

    public function messages()
    {
        # code...
        return $this->hasMany(Messages::class, 'user_id');
    }
}
