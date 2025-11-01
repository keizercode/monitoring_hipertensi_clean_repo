<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReminderLog extends Model
{
    protected $fillable = [
        'medication_reminder_id', 'patient_id', 
        'scheduled_at', 'taken_at', 'status'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'taken_at' => 'datetime',
    ];

    public function reminder()
    {
        return $this->belongsTo(MedicationReminder::class, 'medication_reminder_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
