<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'hospital_id',
        'date_of_birth',
        'gender',
        'address',
        'emergency_contact',
        'medical_history',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
