@extends('layouts.app')

@section('title', 'Dashboard - Tension Track')
@section('header', 'Dashboard')

@section('content')
<!-- Stats Cards - Responsive Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
    <!-- Total Pasien -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-xs sm:text-sm mb-1">Total Pasien</p>
                <h3 class="text-2xl sm:text-3xl font-bold">{{ $totalPatients }}</h3>
            </div>
            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Pengukuran Hari Ini -->
    <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-teal-100 text-xs sm:text-sm mb-1">Pengukuran Hari Ini</p>
                <h3 class="text-2xl sm:text-3xl font-bold">{{ $todayRecords }}</h3>
            </div>
            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <i class="fas fa-heartbeat text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition sm:col-span-2 lg:col-span-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-xs sm:text-sm mb-1">Tambah Pasien</p>
                <a href="{{ route('patients.create') }}" class="inline-flex items-center mt-2 text-white hover:text-purple-100">
                    <span class="font-semibold text-sm sm:text-base">Klik di sini</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-plus text-xl sm:text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Kategori Tekanan Darah - Responsive Table -->
<div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6">
    <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-info-circle text-teal-500 mr-2"></i>
        Kategori Tekanan Darah (Standar AHA 2025)
    </h3>

    <div class="overflow-x-auto -mx-4 sm:mx-0">
        <div class="inline-block min-w-full align-middle">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 text-xs sm:text-sm">KATEGORI</th>
                        <th class="text-center py-3 px-2 sm:px-4 font-semibold text-gray-700 text-xs sm:text-sm">SISTOLIK</th>
                        <th class="text-center py-3 px-2 sm:px-4 font-semibold text-gray-700 text-xs sm:text-sm">DIASTOLIK</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-green-50">
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Normal</span>
                                <span class="sm:hidden">Normal</span>
                            </span>
                        </td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">< 120</td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">< 80</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-green-50">
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <i class="fas fa-exclamation-circle mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Pra-hipertensi</span>
                                <span class="sm:hidden">Pra-hipertensi</span>
                            </span>
                        </td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">120-129</td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">< 80</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-yellow-50">
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Hipertensi Stadium 1</span>
                                <span class="sm:hidden">Stadium 1</span>
                            </span>
                        </td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">130–139</td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">80–89</td>
                    </tr>
                    <tr class="hover:bg-red-50">
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Hipertensi Stadium 2</span>
                                <span class="sm:hidden">Stadium 2</span>
                            </span>
                        </td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">≥ 140</td>
                        <td class="text-center py-3 px-2 sm:px-4 font-medium text-sm sm:text-base">≥ 90</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart & Recent Patients - Responsive Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <!-- Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-4">
            <span class="hidden sm:inline">Grafik Rata-rata Tekanan Darah (6 Bulan Terakhir)</span>
            <span class="sm:hidden">Grafik 6 Bulan</span>
        </h3>
        <div class="relative" style="height: 250px; sm:height: 300px;">
            <canvas id="bloodPressureChart"></canvas>
        </div>
    </div>

    <!-- Recent Patients -->
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
        <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-4">Pasien Terbaru</h3>
        <div class="space-y-3">
            @forelse($recentPatients as $patient)
                <a href="{{ route('patients.show', $patient) }}" class="block p-3 rounded-lg hover:bg-teal-50 transition border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                            {{ strtoupper(substr($patient->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800 truncate text-sm sm:text-base">{{ $patient->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $patient->nik }}</p>
                        </div>
                        @if($patient->getLatestBloodPressure())
                            @php
                                $latest = $patient->getLatestBloodPressure();
                                $categoryColors = [
                                    'Normal' => 'bg-green-100 text-green-800',
                                    'Hipertensi Stadium 1' => 'bg-yellow-100 text-yellow-800',
                                    'Hipertensi Stadium 2' => 'bg-red-100 text-red-800',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $categoryColors[$latest->category] ?? 'bg-gray-100 text-gray-800' }} whitespace-nowrap">
                                {{ $latest->systolic }}/{{ $latest->diastolic }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-400 py-8 text-sm">Belum ada pasien</p>
            @endforelse
        </div>

        @if($recentPatients->count() > 0)
            <a href="{{ route('patients.index') }}" class="block text-center text-teal-600 font-medium mt-4 hover:text-teal-700 text-sm sm:text-base">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('bloodPressureChart').getContext('2d');
    const chartData = @json($chartData);

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(d => {
                // Shorten month names on mobile
                if (window.innerWidth < 640) {
                    return d.month.substring(0, 3);
                }
                return d.month;
            }),
            datasets: [
                {
                    label: 'Sistolik',
                    data: chartData.map(d => d.systolic),
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderColor: 'rgb(239, 68, 68)',
                    borderWidth: 2,
                    borderRadius: window.innerWidth < 640 ? 4 : 8,
                },
                {
                    label: 'Diastolik',
                    data: chartData.map(d => d.diastolic),
                    backgroundColor: 'rgba(20, 184, 166, 0.8)',
                    borderColor: 'rgb(20, 184, 166)',
                    borderWidth: 2,
                    borderRadius: window.innerWidth < 640 ? 4 : 8,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: window.innerWidth < 640 ? 10 : 15,
                        usePointStyle: true,
                        font: {
                            size: window.innerWidth < 640 ? 10 : 12,
                            family: 'Poppins'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: window.innerWidth < 640 ? 8 : 12,
                    titleFont: {
                        size: window.innerWidth < 640 ? 12 : 14,
                        family: 'Poppins'
                    },
                    bodyFont: {
                        size: window.innerWidth < 640 ? 11 : 13,
                        family: 'Poppins'
                    },
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y + ' mmHg';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 200,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: window.innerWidth < 640 ? 10 : 12,
                            family: 'Poppins'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: window.innerWidth < 640 ? 9 : 11,
                            family: 'Poppins'
                        }
                    }
                }
            }
        }
    });

    // Update chart on window resize
    window.addEventListener('resize', function() {
        chart.data.labels = chartData.map(d => {
            if (window.innerWidth < 640) {
                return d.month.substring(0, 3);
            }
            return d.month;
        });
        chart.update();
    });
</script>
@endpush
