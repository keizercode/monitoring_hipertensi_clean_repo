<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PatientController extends Controller
{   
    use AuthorizesRequests;
    public function index()
    {
        $patients = Patient::where('user_id', Auth::id())
            ->with('bloodPressureRecords')
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
            'nik' => 'required|string|unique:patients',
            'medical_history' => 'nullable|string',
            'age' => 'nullable|integer|min:0|max:150',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
        ]);

        Patient::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'nik' => $request->nik,
            'medical_history' => $request->medical_history,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);
        
        $patient->load(['bloodPressureRecords' => function($query) {
            $query->orderBy('measurement_date', 'desc')
                  ->orderBy('measurement_time', 'desc');
        }]);
        
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:patients,nik,' . $patient->id,
            'medical_history' => 'nullable|string',
            'age' => 'nullable|integer|min:0|max:150',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);
        
        $patient->delete();
        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil dihapus!');
    }
}