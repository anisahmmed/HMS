<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'bmdc_registration_number',
        'qualifications',
        'experience_years',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
