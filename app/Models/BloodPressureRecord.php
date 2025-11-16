<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodPressureRecord extends Model
{
    protected $fillable = [
        'patient_id', 'systolic', 'diastolic', 'symptoms',
        'measurement_date', 'measurement_time', 'category'
    ];

    protected $casts = [
        'measurement_date' => 'date',
        'measurement_time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function determineCategory($systolic, $diastolic)
    {
        if ($systolic < 120 && $diastolic < 80) {
            return 'Normal';
        } elseif (($systolic >= 120 && $systolic <= 129) ||
                  ($diastolic < 80)) {
            return 'Pra-hipertensi';
        } elseif (($systolic >= 130 && $systolic <= 139) ||
                  ($diastolic >= 80 && $diastolic <= 89)) {
            return 'Hipertensi Stadium 1';
        } elseif ($systolic >= 140 || $diastolic >= 90) {
            return 'Hipertensi Stadium 2';
        }
        return 'Normal';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
            $record->category = self::determineCategory(
                $record->systolic,
                $record->diastolic
            );
        });
    }
}
