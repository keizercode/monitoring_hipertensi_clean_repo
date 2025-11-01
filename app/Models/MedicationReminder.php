<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationReminder extends Model
{
    protected $fillable = [
        'patient_id', 'medication_name', 'dosage', 
        'reminder_time', 'reminder_days', 'is_active'
    ];

    protected $casts = [
        'reminder_days' => 'array',
        'is_active' => 'boolean',
        'reminder_time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function logs()
    {
        return $this->hasMany(ReminderLog::class);
    }
}
