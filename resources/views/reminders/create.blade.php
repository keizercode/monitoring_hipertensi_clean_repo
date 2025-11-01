@extends('layouts.app')

@section('title', 'Tambah Pengingat - Tension Track')
@section('header', 'Tambah Pengingat Obat')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('reminders.index', $patient) }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Pengingat Obat</h2>
                <p class="text-gray-600">{{ $patient->name }} - {{ $patient->nik }}</p>
            </div>
        </div>
        
        <form action="{{ route('reminders.store', $patient) }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nama Obat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NAMA OBAT</label>
                <input type="text" name="medication_name" value="{{ old('medication_name') }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="Contoh: Amlodipine 5mg">
                @error('medication_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Dosis -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">DOSIS & ATURAN PAKAI</label>
                <input type="text" name="dosage" value="{{ old('dosage') }}"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="Contoh: 1 tablet sesudah makan">
                @error('dosage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Waktu Pengingat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">JAM PENGINGAT</label>
                <input type="time" name="reminder_time" value="{{ old('reminder_time', '08:00') }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                @error('reminder_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Hari -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">PILIH HARI</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @php
                        $days = [
                            0 => 'Minggu',
                            1 => 'Senin',
                            2 => 'Selasa',
                            3 => 'Rabu',
                            4 => 'Kamis',
                            5 => 'Jumat',
                            6 => 'Sabtu'
                        ];
                    @endphp
                    
                    @foreach($days as $value => $day)
                        <label class="flex items-center p-3 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-teal-500 transition">
                            <input type="checkbox" name="reminder_days[]" value="{{ $value }}" 
                                   class="w-5 h-5 text-teal-600 rounded focus:ring-2 focus:ring-teal-500"
                                   {{ in_array($value, old('reminder_days', [])) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 font-medium">{{ $day }}</span>
                        </label>
                    @endforeach
                </div>
                @error('reminder_days')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="flex space-x-3 pt-4">
                <a href="{{ route('reminders.index', $patient) }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition font-medium shadow-lg">
                    <i class="fas fa-bell mr-2"></i>Simpan Pengingat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
