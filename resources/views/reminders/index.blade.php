@extends('layouts.app')

@section('title', 'Pengingat Obat - Tension Track')
@section('header', 'Pengingat Obat')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('patients.show', $patient) }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pengingat Obat</h2>
                <p class="text-gray-600">{{ $patient->name }} - {{ $patient->nik }}</p>
            </div>
        </div>
        <a href="{{ route('reminders.create', $patient) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition shadow-lg">
            <i class="fas fa-plus mr-2"></i>
            Tambah Pengingat
        </a>
    </div>
</div>

@if($reminders->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($reminders as $reminder)
            <div class="bg-white rounded-xl shadow-lg p-6 {{ $reminder->is_active ? '' : 'opacity-60' }}">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-pills text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $reminder->medication_name }}</h3>
                            @if($reminder->dosage)
                                <p class="text-sm text-gray-600">{{ $reminder->dosage }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <form action="{{ route('reminders.toggle', [$patient, $reminder]) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="relative inline-flex items-center h-6 rounded-full w-11 transition {{ $reminder->is_active ? 'bg-teal-500' : 'bg-gray-300' }}">
                            <span class="inline-block w-4 h-4 transform transition bg-white rounded-full {{ $reminder->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                        </button>
                    </form>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-clock text-teal-500 w-5 mr-3"></i>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($reminder->reminder_time)->format('H:i') }} WIB</span>
                    </div>
                    
                    <div class="flex items-start text-gray-700">
                        <i class="fas fa-calendar-alt text-teal-500 w-5 mr-3 mt-1"></i>
                        <div>
                            <p class="font-medium mb-2">Hari:</p>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                @endphp
                                @foreach($reminder->reminder_days as $day)
                                    <span class="px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-xs font-medium">
                                        {{ $days[$day] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200 flex justify-end">
                    <form action="{{ route('reminders.destroy', [$patient, $reminder]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengingat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <i class="fas fa-bell-slash text-gray-300 text-6xl mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pengingat</h3>
        <p class="text-gray-600 mb-6">Tambahkan pengingat obat untuk pasien ini</p>
        <a href="{{ route('reminders.create', $patient) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition shadow-lg">
            <i class="fas fa-plus mr-2"></i>
            Tambah Pengingat Pertama
        </a>
    </div>
@endif
@endsection