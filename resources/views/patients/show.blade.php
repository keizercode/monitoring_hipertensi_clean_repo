@extends('layouts.app')

@section('title', 'Detail Pasien - Tension Track')
@section('header', 'Detail Pasien')

@section('content')
<!-- Patient Info Card - Responsive -->
<div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-4 sm:mb-6">
    <div class="flex flex-col space-y-4 mb-4 sm:mb-6">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <a href="{{ route('patients.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center text-white text-xl sm:text-2xl font-bold flex-shrink-0">
                {{ strtoupper(substr($patient->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 truncate">{{ $patient->name }}</h2>
                <p class="text-sm sm:text-base text-gray-600 truncate">NIK: {{ $patient->nik }}</p>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('patients.edit', $patient) }}" class="flex-1 sm:flex-none px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-center text-sm sm:text-base">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('blood-pressure.create', $patient) }}" class="flex-1 sm:flex-none px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition shadow-lg text-center text-sm sm:text-base">
                <i class="fas fa-plus mr-2"></i>Input Tekanan Darah
            </a>
        </div>
    </div>
    
    <!-- Patient Stats - Responsive Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-blue-50 p-3 sm:p-4 rounded-lg">
            <p class="text-blue-600 text-xs font-medium mb-1">USIA</p>
            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $patient->age ?? '-' }}</p>
            <p class="text-xs text-gray-600">tahun</p>
        </div>
        
        <div class="bg-purple-50 p-3 sm:p-4 rounded-lg">
            <p class="text-purple-600 text-xs font-medium mb-1">TB</p>
            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $patient->height ?? '-' }}</p>
            <p class="text-xs text-gray-600">cm</p>
        </div>
        
        <div class="bg-pink-50 p-3 sm:p-4 rounded-lg">
            <p class="text-pink-600 text-xs font-medium mb-1">BB</p>
            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $patient->weight ?? '-' }}</p>
            <p class="text-xs text-gray-600">kg</p>
        </div>
        
        <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
            <p class="text-green-600 text-xs font-medium mb-1">BMI</p>
            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $patient->getBMI() ?? '-' }}</p>
            <p class="text-xs text-gray-600">kg/m²</p>
        </div>
    </div>
    
    @if($patient->medical_history)
        <div class="mt-4 p-3 sm:p-4 bg-amber-50 rounded-lg border-l-4 border-amber-500">
            <p class="text-amber-800 text-xs sm:text-sm font-medium mb-1">
                <i class="fas fa-clipboard-list mr-2"></i>Riwayat Penyakit
            </p>
            <p class="text-gray-700 text-sm sm:text-base">{{ $patient->medical_history }}</p>
        </div>
    @endif
</div>

<!-- Quick Actions - Responsive Grid -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-4 sm:mb-6">
    <a href="{{ route('blood-pressure.history', $patient) }}" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-4 sm:p-6 hover:shadow-lg transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-xs sm:text-sm mb-1">Riwayat Lengkap</p>
                <h3 class="text-xl sm:text-2xl font-bold">{{ $patient->bloodPressureRecords->count() }}</h3>
            </div>
            <i class="fas fa-history text-2xl sm:text-3xl text-white opacity-50"></i>
        </div>
    </a>
    
    <a href="{{ route('blood-pressure.chart', $patient) }}" class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-4 sm:p-6 hover:shadow-lg transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-xs sm:text-sm mb-1">Grafik Trend</p>
                <h3 class="text-xl sm:text-2xl font-bold">Lihat</h3>
            </div>
            <i class="fas fa-chart-line text-2xl sm:text-3xl text-white opacity-50"></i>
        </div>
    </a>
    
    <a href="{{ route('reminders.index', $patient) }}" class="bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-xl p-4 sm:p-6 hover:shadow-lg transition transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-teal-100 text-xs sm:text-sm mb-1">Pengingat Obat</p>
                <h3 class="text-xl sm:text-2xl font-bold">{{ $patient->medicationReminders->count() }}</h3>
            </div>
            <i class="fas fa-bell text-2xl sm:text-3xl text-white opacity-50"></i>
        </div>
    </a>
</div>

<!-- Latest Records - Responsive -->
<div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base sm:text-lg font-bold text-gray-800">
            <i class="fas fa-heartbeat text-teal-500 mr-2"></i>
            Riwayat Terbaru
        </h3>
        @if($patient->bloodPressureRecords->count() > 0)
            <a href="{{ route('blood-pressure.history', $patient) }}" class="text-teal-600 hover:text-teal-700 text-xs sm:text-sm font-medium">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @endif
    </div>
    
    @if($patient->bloodPressureRecords->count() > 0)
        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">TANGGAL & WAKTU</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">SISTOL/DIASTOL</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">KATEGORI</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">KELUHAN</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($patient->bloodPressureRecords->take(5) as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800">{{ $record->measurement_date->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $record->measurement_time->format('H:i') }}</p>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-lg font-bold text-gray-800">{{ $record->systolic }}/{{ $record->diastolic }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $categoryColors = [
                                        'Normal' => 'bg-green-100 text-green-800',
                                        'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800',
                                        'Hipertensi Stadium 2' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $categoryColors[$record->category] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $record->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 text-sm">
                                {{ $record->symptoms ? Str::limit($record->symptoms, 50) : '-' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('blood-pressure.destroy', $record) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Cards -->
        <div class="sm:hidden space-y-3">
            @foreach($patient->bloodPressureRecords->take(5) as $record)
                <div class="border border-gray-200 rounded-lg p-3">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-medium text-gray-800 text-sm">{{ $record->measurement_date->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $record->measurement_time->format('H:i') }}</p>
                        </div>
                        @php
                            $categoryColors = [
                                'Normal' => 'bg-green-100 text-green-800',
                                'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800',
                                'Hipertensi Stadium 2' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $categoryColors[$record->category] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $record->systolic }}/{{ $record->diastolic }}
                        </span>
                    </div>
                    @if($record->symptoms)
                        <p class="text-xs text-gray-600 mb-2">{{ Str::limit($record->symptoms, 80) }}</p>
                    @endif
                    <form action="{{ route('blood-pressure.destroy', $record) }}" method="POST" class="text-right">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete(this)" class="text-red-500 hover:text-red-700 text-sm">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8 sm:py-12">
            <i class="fas fa-heartbeat text-gray-300 text-4xl sm:text-5xl mb-4"></i>
            <p class="text-gray-500 text-sm sm:text-base">Belum ada data tekanan darah</p>
            <a href="{{ route('blood-pressure.create', $patient) }}" class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-medium text-sm sm:text-base">
                Input Data Pertama <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(button) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            button.closest('form').submit();
        }
    }
</script>
@endpush