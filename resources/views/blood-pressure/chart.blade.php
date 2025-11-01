@extends('layouts.app')

@section('title', 'Grafik Tekanan Darah - Tension Track')
@section('header', 'Grafik')

@section('content')
<div class="mb-4 sm:mb-6">
    <div class="flex items-center mb-4">
        <a href="{{ route('patients.show', $patient) }}" class="mr-3 sm:mr-4 text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="flex-1 min-w-0">
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 truncate">Grafik Trend</h2>
            <p class="text-sm sm:text-base text-gray-600 truncate">{{ $patient->name }}</p>
        </div>
    </div>
</div>

<!-- Chart Card - Fully Responsive -->
<div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-4 sm:mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3">
        <h3 class="text-base sm:text-lg font-bold text-gray-800">
            <i class="fas fa-chart-line text-teal-500 mr-2"></i>
            <span class="hidden sm:inline">Grafik Tekanan Darah</span>
            <span class="sm:hidden">Grafik TD</span>
        </h3>
        <div class="flex space-x-2">
            <button onclick="changeChartType('line')" id="btnLine" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-teal-500 text-white rounded-lg text-xs sm:text-sm font-medium">
                <i class="fas fa-chart-line mr-1"></i><span class="hidden sm:inline">Line</span>
            </button>
            <button onclick="changeChartType('bar')" id="btnBar" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-xs sm:text-sm font-medium">
                <i class="fas fa-chart-bar mr-1"></i><span class="hidden sm:inline">Bar</span>
            </button>
        </div>
    </div>
    
    <div class="relative" style="height: 280px; sm:height: 350px; lg:height: 400px;">
        <canvas id="trendChart"></canvas>
    </div>
</div>

<!-- Statistics - Responsive Grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 sm:p-6 text-white">
        <p class="text-blue-100 text-xs mb-1 sm:mb-2">Total Pengukuran</p>
        <h3 class="text-2xl sm:text-3xl font-bold">{{ $records->count() }}</h3>
        <p class="text-blue-100 text-xs mt-1 sm:mt-2">
            <i class="fas fa-calendar-alt mr-1"></i>Semua waktu
        </p>
    </div>
    
    @php
        $avgSystolic = $records->avg('systolic');
        $maxSystolic = $records->max('systolic');
        $minSystolic = $records->min('systolic');
    @endphp
    
    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-4 sm:p-6 text-white">
        <p class="text-red-100 text-xs mb-1 sm:mb-2">Rata-rata Sistolik</p>
        <h3 class="text-2xl sm:text-3xl font-bold">{{ round($avgSystolic) }}</h3>
        <p class="text-red-100 text-xs mt-1 sm:mt-2 truncate">
            Max: {{ $maxSystolic }} | Min: {{ $minSystolic }}
        </p>
    </div>
    
    @php
        $avgDiastolic = $records->avg('diastolic');
        $maxDiastolic = $records->max('diastolic');
        $minDiastolic = $records->min('diastolic');
    @endphp
    
    <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl p-4 sm:p-6 text-white">
        <p class="text-teal-100 text-xs mb-1 sm:mb-2">Rata-rata Diastolik</p>
        <h3 class="text-2xl sm:text-3xl font-bold">{{ round($avgDiastolic) }}</h3>
        <p class="text-teal-100 text-xs mt-1 sm:mt-2 truncate">
            Max: {{ $maxDiastolic }} | Min: {{ $minDiastolic }}
        </p>
    </div>
    
    @php
        $normalCount = $records->where('category', 'Normal')->count();
        $hypertension1Count = $records->where('category', 'Hipertensi Stadium 1')->count();
        $hypertension2Count = $records->where('category', 'Hipertensi Stadium 2')->count();
        $mostFrequent = 'Normal';
        $mostCount = $normalCount;
        
        if ($hypertension1Count > $mostCount) {
            $mostFrequent = 'Stadium 1';
            $mostCount = $hypertension1Count;
        }
        if ($hypertension2Count > $mostCount) {
            $mostFrequent = 'Stadium 2';
            $mostCount = $hypertension2Count;
        }
    @endphp
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 sm:p-6 text-white">
        <p class="text-purple-100 text-xs mb-1 sm:mb-2">Terbanyak</p>
        <h3 class="text-xl sm:text-2xl font-bold">{{ $mostFrequent }}</h3>
        <p class="text-purple-100 text-xs mt-1 sm:mt-2">
            {{ $mostCount }}x ({{ round($mostCount / $records->count() * 100) }}%)
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('trendChart').getContext('2d');
    const records = @json($records);
    
    const labels = records.map(r => {
        const date = new Date(r.measurement_date);
        if (window.innerWidth < 640) {
            return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }).substring(0, 5);
        }
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
    });
    
    const systolicData = records.map(r => r.systolic);
    const diastolicData = records.map(r => r.diastolic);
    
    let currentChartType = 'line';
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Sistolik',
                    data: systolicData,
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderColor: 'rgb(239, 68, 68)',
                    borderWidth: window.innerWidth < 640 ? 2 : 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: window.innerWidth < 640 ? 3 : 5,
                    pointHoverRadius: window.innerWidth < 640 ? 5 : 7,
                    pointBackgroundColor: 'rgb(239, 68, 68)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                },
                {
                    label: 'Diastolik',
                    data: diastolicData,
                    backgroundColor: 'rgba(20, 184, 166, 0.1)',
                    borderColor: 'rgb(20, 184, 166)',
                    borderWidth: window.innerWidth < 640 ? 2 : 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: window.innerWidth < 640 ? 3 : 5,
                    pointHoverRadius: window.innerWidth < 640 ? 5 : 7,
                    pointBackgroundColor: 'rgb(20, 184, 166)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: window.innerWidth < 640 ? 'bottom' : 'top',
                    labels: {
                        padding: window.innerWidth < 640 ? 10 : 20,
                        usePointStyle: true,
                        font: {
                            size: window.innerWidth < 640 ? 11 : 14,
                            family: 'Poppins',
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: window.innerWidth < 640 ? 10 : 15,
                    titleFont: {
                        size: window.innerWidth < 640 ? 12 : 16,
                        family: 'Poppins'
                    },
                    bodyFont: {
                        size: window.innerWidth < 640 ? 11 : 14,
                        family: 'Poppins'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 40,
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
                        },
                        maxRotation: window.innerWidth < 640 ? 45 : 45,
                        minRotation: window.innerWidth < 640 ? 45 : 45
                    }
                }
            }
        }
    });
    
    function changeChartType(type) {
        currentChartType = type;
        
        document.getElementById('btnLine').className = type === 'line' 
            ? 'flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-teal-500 text-white rounded-lg text-xs sm:text-sm font-medium'
            : 'flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-xs sm:text-sm font-medium';
        
        document.getElementById('btnBar').className = type === 'bar'
            ? 'flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-teal-500 text-white rounded-lg text-xs sm:text-sm font-medium'
            : 'flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-xs sm:text-sm font-medium';
        
        chart.destroy();
        
        chart = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sistolik',
                        data: systolicData,
                        backgroundColor: type === 'bar' ? 'rgba(239, 68, 68, 0.8)' : 'rgba(239, 68, 68, 0.1)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: type === 'bar' ? 2 : (window.innerWidth < 640 ? 2 : 3),
                        fill: type === 'line',
                        tension: 0.4,
                        pointRadius: type === 'line' ? (window.innerWidth < 640 ? 3 : 5) : 0,
                        borderRadius: type === 'bar' ? (window.innerWidth < 640 ? 4 : 8) : 0,
                    },
                    {
                        label: 'Diastolik',
                        data: diastolicData,
                        backgroundColor: type === 'bar' ? 'rgba(20, 184, 166, 0.8)' : 'rgba(20, 184, 166, 0.1)',
                        borderColor: 'rgb(20, 184, 166)',
                        borderWidth: type === 'bar' ? 2 : (window.innerWidth < 640 ? 2 : 3),
                        fill: type === 'line',
                        tension: 0.4,
                        pointRadius: type === 'line' ? (window.innerWidth < 640 ? 3 : 5) : 0,
                        borderRadius: type === 'bar' ? (window.innerWidth < 640 ? 4 : 8) : 0,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: window.innerWidth < 640 ? 'bottom' : 'top',
                        labels: {
                            padding: window.innerWidth < 640 ? 10 : 20,
                            usePointStyle: true,
                            font: {
                                size: window.innerWidth < 640 ? 11 : 14,
                                family: 'Poppins',
                                weight: '600'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 40,
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
    }
    
    // Responsive chart update
    window.addEventListener('resize', function() {
        chart.update();
    });
</script>
@endpush