<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicationReminder;
use Illuminate\Http\Request;

class MedicationReminderController extends Controller
{
    public function index(Patient $patient)
    {
        $reminders = $patient->medicationReminders()
            ->orderBy('reminder_time')
            ->get();
        
        return view('reminders.index', compact('patient', 'reminders'));
    }

    public function create(Patient $patient)
    {
        return view('reminders.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'medication_name' => 'required|string|max:255',
            'dosage' => 'nullable|string',
            'reminder_time' => 'required',
            'reminder_days' => 'required|array',
        ]);

        MedicationReminder::create([
            'patient_id' => $patient->id,
            'medication_name' => $request->medication_name,
            'dosage' => $request->dosage,
            'reminder_time' => $request->reminder_time,
            'reminder_days' => $request->reminder_days,
        ]);

        return redirect()->route('reminders.index', $patient)
            ->with('success', 'Pengingat obat berhasil ditambahkan!');
    }

    public function destroy(Patient $patient, MedicationReminder $reminder)
    {
        $reminder->delete();
        
        return redirect()->route('reminders.index', $patient)
            ->with('success', 'Pengingat obat berhasil dihapus!');
    }

    public function toggle(Patient $patient, MedicationReminder $reminder)
    {
        $reminder->update([
            'is_active' => !$reminder->is_active
        ]);
        
        return back()->with('success', 'Status pengingat berhasil diubah!');
    }
}
