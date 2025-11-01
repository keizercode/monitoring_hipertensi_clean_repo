<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MedicationReminderController;
use App\Http\Controllers\ProfileController;

// Authentication Routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Patients
    Route::resource('patients', PatientController::class);
    
    // Blood Pressure
    Route::get('/patients/{patient}/blood-pressure/create', [BloodPressureController::class, 'create'])
        ->name('blood-pressure.create');
    Route::post('/patients/{patient}/blood-pressure', [BloodPressureController::class, 'store'])
        ->name('blood-pressure.store');
    Route::get('/patients/{patient}/blood-pressure/history', [BloodPressureController::class, 'history'])
        ->name('blood-pressure.history');
    Route::get('/patients/{patient}/blood-pressure/chart', [BloodPressureController::class, 'chart'])
        ->name('blood-pressure.chart');
    Route::delete('/blood-pressure/{record}', [BloodPressureController::class, 'destroy'])
        ->name('blood-pressure.destroy');
    
    // Education
    Route::get('/education', [EducationController::class, 'index'])->name('education.index');
    Route::get('/education/{content}', [EducationController::class, 'show'])->name('education.show');
    
    // Medication Reminders
    Route::get('/patients/{patient}/reminders', [MedicationReminderController::class, 'index'])
        ->name('reminders.index');
    Route::get('/patients/{patient}/reminders/create', [MedicationReminderController::class, 'create'])
        ->name('reminders.create');
    Route::post('/patients/{patient}/reminders', [MedicationReminderController::class, 'store'])
        ->name('reminders.store');
    Route::delete('/patients/{patient}/reminders/{reminder}', [MedicationReminderController::class, 'destroy'])
        ->name('reminders.destroy');
    Route::post('/patients/{patient}/reminders/{reminder}/toggle', [MedicationReminderController::class, 'toggle'])
        ->name('reminders.toggle');
});
