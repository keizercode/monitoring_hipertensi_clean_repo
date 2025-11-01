@extends('layouts.app')

@section('title', 'Daftar Pasien - Tension Track')
@section('header', 'Daftar Pasien')

@section('content')
<div class="mb-4 sm:mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 gap-4">
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Daftar Pasien</h2>
        <p class="text-sm sm:text-base text-gray-600">Kelola data pasien Anda</p>
    </div>
    <a href="{{ route('patients.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base">
        <i class="fas fa-plus mr-2"></i>
        Tambah Pasien
    </a>
</div>

<!-- Desktop Table View -->
<div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-teal-500 to-teal-600 text-white">
                <tr>
                    <th class="px-4 lg:px-6 py-4 text-left text-sm font-semibold">NO</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-sm font-semibold">NAMA</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-sm font-semibold">NIK</th>
                    <th class="px-4 lg:px-6 py-4 text-center text-sm font-semibold">USIA</th>
                    <th class="px-4 lg:px-6 py-4 text-center text-sm font-semibold">STATUS</th>
                    <th class="px-4 lg:px-6 py-4 text-center text-sm font-semibold">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($patients as $index => $patient)
                    <tr class="hover:bg-teal-50 transition">
                        <td class="px-4 lg:px-6 py-4 text-gray-700">{{ $patients->firstItem() + $index }}</td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($patient->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-medium text-gray-800">{{ $patient->name }}</p>
                                    @if($patient->medical_history)
                                        <p class="text-xs text-gray-500 truncate">{{ Str::limit($patient->medical_history, 30) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-gray-700">{{ $patient->nik }}</td>
                        <td class="px-4 lg:px-6 py-4 text-center">
                            <span class="font-medium text-gray-800">{{ $patient->age ?? '-' }}</span>
                            @if($patient->age)
                                <span class="text-xs text-gray-500 block">tahun</span>
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-center">
                            @php
                                $latest = $patient->getLatestBloodPressure();
                            @endphp
                            @if($latest)
                                @php
                                    $categoryColors = [
                                        'Normal' => 'bg-green-100 text-green-800',
                                        'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800',
                                        'Hipertensi Stadium 2' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $categoryColors[$latest->category] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $latest->category }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">Belum ada data</span>
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('patients.show', $patient) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('blood-pressure.create', $patient) }}" class="p-2 bg-teal-100 text-teal-600 rounded-lg hover:bg-teal-200 transition" title="Input">
                                    <i class="fas fa-heartbeat"></i>
                                </a>
                                <a href="{{ route('patients.edit', $patient) }}" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Belum ada data pasien</p>
                                <a href="{{ route('patients.create') }}" class="mt-4 text-teal-600 hover:text-teal-700 font-medium">
                                    Tambah Pasien Pertama <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($patients->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $patients->links() }}
        </div>
    @endif
</div>

<!-- Mobile Card View -->
<div class="md:hidden space-y-4">
    @forelse($patients as $patient)
        <div class="bg-white rounded-xl shadow-lg p-4">
            <div class="flex items-start space-x-3 mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                    {{ strtoupper(substr($patient->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 truncate">{{ $patient->name }}</h3>
                    <p class="text-xs text-gray-500">NIK: {{ $patient->nik }}</p>
                    @if($patient->age)
                        <p class="text-xs text-gray-500">Usia: {{ $patient->age }} tahun</p>
                    @endif
                </div>
                @php
                    $latest = $patient->getLatestBloodPressure();
                @endphp
                @if($latest)
                    @php
                        $categoryColors = [
                            'Normal' => 'bg-green-100 text-green-800',
                            'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800',
                            'Hipertensi Stadium 2' => 'bg-red-100 text-red-800',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $categoryColors[$latest->category] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $latest->systolic }}/{{ $latest->diastolic }}
                    </span>
                @endif
            </div>
            
            <div class="grid grid-cols-3 gap-2">
                <a href="{{ route('patients.show', $patient) }}" class="flex flex-col items-center justify-center p-3 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                    <i class="fas fa-eye mb-1"></i>
                    <span class="text-xs">Detail</span>
                </a>
                <a href="{{ route('blood-pressure.create', $patient) }}" class="flex flex-col items-center justify-center p-3 bg-teal-50 text-teal-600 rounded-lg hover:bg-teal-100 transition">
                    <i class="fas fa-heartbeat mb-1"></i>
                    <span class="text-xs">Input</span>
                </a>
                <a href="{{ route('patients.edit', $patient) }}" class="flex flex-col items-center justify-center p-3 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition">
                    <i class="fas fa-edit mb-1"></i>
                    <span class="text-xs">Edit</span>
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mb-4">Belum ada data pasien</p>
            <a href="{{ route('patients.create') }}" class="inline-block text-teal-600 hover:text-teal-700 font-medium">
                Tambah Pasien Pertama <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    @endforelse
    
    @if($patients->hasPages())
        <div class="mt-4">
            {{ $patients->links() }}
        </div>
    @endif
</div>
@endsection