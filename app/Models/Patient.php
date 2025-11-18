<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'name', 'nik', 'date_of_birth', 'medical_history',
        'height', 'weight'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
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

    /**
     * Calculate age from date of birth
     */
    public function getAgeAttribute()
    {
        if (!$this->date_of_birth) {
            return null;
        }

        return Carbon::parse($this->date_of_birth)->age;
    }

    /**
     * Get age in years and months (optional, for more detail)
     */
    public function getDetailedAge()
    {
        if (!$this->date_of_birth) {
            return null;
        }

        $now = Carbon::now();
        $dob = Carbon::parse($this->date_of_birth);

        $years = $dob->diffInYears($now);
        $months = $dob->copy()->addYears($years)->diffInMonths($now);

        return [
            'years' => $years,
            'months' => $months
        ];
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
