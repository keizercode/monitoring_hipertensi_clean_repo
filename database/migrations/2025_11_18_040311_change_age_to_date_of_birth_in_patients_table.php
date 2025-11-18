<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Tambah kolom date_of_birth dulu (nullable)
            $table->date('date_of_birth')->nullable()->after('nik');
        });

        // Konversi data age ke date_of_birth untuk data yang sudah ada
        // Estimasi tanggal lahir dari umur (1 Januari tahun lahir)
        $patients = DB::table('patients')->whereNotNull('age')->get();

        foreach ($patients as $patient) {
            $birthYear = Carbon::now()->year - $patient->age;
            $estimatedDOB = Carbon::create($birthYear, 1, 1)->format('Y-m-d');

            DB::table('patients')
                ->where('id', $patient->id)
                ->update(['date_of_birth' => $estimatedDOB]);
        }

        // Sekarang hapus kolom age
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Kembalikan kolom age
            $table->integer('age')->nullable()->after('medical_history');
        });

        // Konversi date_of_birth kembali ke age
        $patients = DB::table('patients')->whereNotNull('date_of_birth')->get();

        foreach ($patients as $patient) {
            $age = Carbon::parse($patient->date_of_birth)->age;

            DB::table('patients')
                ->where('id', $patient->id)
                ->update(['age' => $age]);
        }

        // Hapus kolom date_of_birth
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
        });
    }
};
