<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('blood_pressure_records', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        $table->integer('systolic'); // Tekanan sistolik
        $table->integer('diastolic'); // Tekanan diastolik
        $table->text('symptoms')->nullable(); // Keluhan
        $table->date('measurement_date');
        $table->time('measurement_time');
        $table->string('category'); // Normal, Hipertensi Stadium 1, Hipertensi Stadium 2
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pressure_records');
    }
};
