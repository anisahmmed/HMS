<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'serial_number',
        'date',
        'time',
        'status',
        'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            if (empty($appointment->serial_number)) {
                $appointment->serial_number = static::generateSerialNumber($appointment->doctor_id);
            }
        });
    }

    public static function generateSerialNumber($doctorId)
    {
        $lastAppointment = static::where('doctor_id', $doctorId)
            ->orderBy('serial_number', 'desc')
            ->first();

        return $lastAppointment ? $lastAppointment->serial_number + 1 : 1;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}