<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('bloodPressureRecords')
            ->latest()
            ->paginate(10);

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:patients,nik',
            'date_of_birth' => 'required|date|before:today',
            'medical_history' => 'nullable|string',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
        ], [
            'date_of_birth.required' => 'Tanggal lahir wajib diisi',
            'date_of_birth.date' => 'Format tanggal tidak valid',
            'date_of_birth.before' => 'Tanggal lahir harus sebelum hari ini',
        ]);

        Patient::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'nik' => $request->nik,
            'date_of_birth' => $request->date_of_birth,
            'medical_history' => $request->medical_history,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function show(Patient $patient)
    {
        $patient->load(['bloodPressureRecords' => function($query) {
            $query->orderBy('measurement_date', 'desc')
                  ->orderBy('measurement_time', 'desc');
        }]);

        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:patients,nik,' . $patient->id,
            'date_of_birth' => 'required|date|before:today',
            'medical_history' => 'nullable|string',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
        ], [
            'date_of_birth.required' => 'Tanggal lahir wajib diisi',
            'date_of_birth.date' => 'Format tanggal tidak valid',
            'date_of_birth.before' => 'Tanggal lahir harus sebelum hari ini',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil dihapus!');
    }
}
