<?php

namespace App\Console\Commands;

use App\Models\MedicationReminder;
use App\Models\ReminderLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendMedicationReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send medication reminders';

    public function handle()
    {
        $now = Carbon::now();
        $currentDay = $now->dayOfWeek; // 0 = Minggu, 6 = Sabtu
        $currentTime = $now->format('H:i');

        $reminders = MedicationReminder::where('is_active', true)
            ->whereJsonContains('reminder_days', $currentDay)
            ->get();

        foreach ($reminders as $reminder) {
            $reminderTime = Carbon::parse($reminder->reminder_time)->format('H:i');
            
            if ($reminderTime === $currentTime) {
                // Cek apakah sudah ada log hari ini
                $existingLog = ReminderLog::where('medication_reminder_id', $reminder->id)
                    ->whereDate('scheduled_at', $now->toDateString())
                    ->first();

                if (!$existingLog) {
                    ReminderLog::create([
                        'medication_reminder_id' => $reminder->id,
                        'patient_id' => $reminder->patient_id,
                        'scheduled_at' => $now,
                        'status' => 'pending'
                    ]);

                    // Di sini Anda bisa mengirim notifikasi
                    // Contoh: menggunakan Laravel Notification
                    // $reminder->patient->user->notify(new MedicationReminderNotification($reminder));
                    
                    $this->info("Reminder sent for: {$reminder->medication_name}");
                }
            }
        }

        return 0;
    }
}
