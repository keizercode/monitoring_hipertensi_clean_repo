<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'name', 'nik', 'medical_history', 
        'age', 'height', 'weight'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bloodPressureRecords()
    {
        return $this->hasMany(BloodPressureRecord::class);
    }

    public function medicationReminders()
    {
        return $this->hasMany(MedicationReminder::class);
    }

    public function getLatestBloodPressure()
    {
        return $this->bloodPressureRecords()
            ->latest('measurement_date')
            ->latest('measurement_time')
            ->first();
    }

    public function getBMI()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 2);
        }
        return null;
    }
}
