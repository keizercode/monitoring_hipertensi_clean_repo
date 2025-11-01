<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\BloodPressureRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BloodPressureController extends Controller
{
    public function create(Patient $patient)
    {
        return view('blood-pressure.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'systolic' => 'required|integer|min:70|max:250',
            'diastolic' => 'required|integer|min:40|max:150',
            'symptoms' => 'nullable|string',
            'measurement_date' => 'required|date',
            'measurement_time' => 'required',
        ]);

        BloodPressureRecord::create([
            'patient_id' => $patient->id,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'symptoms' => $request->symptoms,
            'measurement_date' => $request->measurement_date,
            'measurement_time' => $request->measurement_time,
        ]);

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Data tekanan darah berhasil ditambahkan!');
    }

    public function history(Patient $patient)
    {
        $records = $patient->bloodPressureRecords()
            ->orderBy('measurement_date', 'desc')
            ->orderBy('measurement_time', 'desc')
            ->paginate(20);
        
        return view('blood-pressure.history', compact('patient', 'records'));
    }

    public function chart(Patient $patient)
    {
        $records = $patient->bloodPressureRecords()
            ->orderBy('measurement_date', 'asc')
            ->get();
        
        return view('blood-pressure.chart', compact('patient', 'records'));
    }

    public function destroy(BloodPressureRecord $record)
    {
        $patientId = $record->patient_id;
        $record->delete();
        
        return redirect()->route('patients.show', $patientId)
            ->with('success', 'Data tekanan darah berhasil dihapus!');
    }
}