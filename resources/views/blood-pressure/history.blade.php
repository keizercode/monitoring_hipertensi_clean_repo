@extends('layouts.app')

@section('title', 'Riwayat Tekanan Darah - Tension Track')
@section('header', 'Riwayat Tekanan Darah')

@section('content')
<div class="mb-6">
    <div class="flex items-center mb-4">
        <a href="{{ route('patients.show', $patient) }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Tekanan Darah</h2>
            <p class="text-gray-600">{{ $patient->name }} - {{ $patient->nik }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6 bg-gradient-to-r from-teal-500 to-teal-600">
        <div class="flex items-center justify-between text-white">
            <div>
                <p class="text-teal-100 text-sm">Total Pengukuran</p>
                <h3 class="text-3xl font-bold">{{ $records->total() }}</h3>
            </div>
            <i class="fas fa-chart-bar text-5xl opacity-20"></i>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">NO</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">TANGGAL & WAKTU</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600">SISTOL</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600">DIASTOL</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600">KATEGORI</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">KELUHAN</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($records as $index => $record)
                    <tr class="hover:bg-teal-50 transition">
                        <td class="px-6 py-4 text-gray-700">{{ $records->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $record->measurement_date->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $record->measurement_time->format('H:i') }} WIB</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-lg">
                                <span class="text-2xl font-bold text-red-600">{{ $record->systolic }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-16 h-16 bg-teal-100 rounded-lg">
                                <span class="text-2xl font-bold text-teal-600">{{ $record->diastolic }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $categoryColors = [
                                    'Normal' => 'bg-green-100 text-green-800 border-green-500',
                                    'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800 border-yellow-500',
                                    'Hipertensi Stadium 2' => 'bg-red-100 text-red-800 border-red-500',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-bold border-2 {{ $categoryColors[$record->category] ?? 'bg-gray-100 text-gray-800 border-gray-500' }}">
                                {{ $record->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $record->symptoms ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <i class="fas fa-heartbeat text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">Belum ada data</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($records->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $records->links() }}
        </div>
    @endif
</div>
@endsection