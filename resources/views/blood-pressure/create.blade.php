@extends('layouts.app')

@section('title', 'Input Tekanan Darah - Tension Track')
@section('header', 'Input Tekanan Darah')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
        <div class="flex items-center mb-4 sm:mb-6">
            <a href="{{ route('patients.show', $patient) }}" class="mr-3 sm:mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="flex-1 min-w-0">
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 truncate">Input Data Tekanan Darah</h2>
                <p class="text-sm sm:text-base text-gray-600 truncate">{{ $patient->name }}</p>
            </div>
        </div>

        <!-- Patient Quick Info - Responsive -->
        <div class="bg-teal-50 border-l-4 border-teal-500 p-3 sm:p-4 rounded-r-lg mb-4 sm:mb-6">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 text-sm">
                <div>
                    <p class="text-xs text-teal-600 font-medium">NAMA</p>
                    <p class="font-semibold text-gray-800 truncate">{{ $patient->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-teal-600 font-medium">USIA</p>
                    <p class="font-semibold text-gray-800">{{ $patient->age ?? '-' }} thn</p>
                </div>
                @if($patient->medical_history)
                    <div class="col-span-2">
                        <p class="text-xs text-teal-600 font-medium">RIWAYAT</p>
                        <p class="font-semibold text-gray-800 truncate">{{ Str::limit($patient->medical_history, 30) }}</p>
                    </div>
                @endif
            </div>
        </div>

        <form action="{{ route('blood-pressure.store', $patient) }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf

            <!-- Tanggal & Jam - Responsive Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">TANGGAL</label>
                    <input type="date" name="measurement_date" value="{{ old('measurement_date', date('Y-m-d')) }}" required
                           class="w-full px-3 sm:px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition text-sm sm:text-base">
                    @error('measurement_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">JAM</label>
                    <input type="time" name="measurement_time" value="{{ old('measurement_time', date('H:i')) }}" required
                           class="w-full px-3 sm:px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition text-sm sm:text-base">
                    @error('measurement_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Systole & Diastole - Responsive -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">SYSTOLE (mmHg)</label>
                    <input type="number" name="systolic" value="{{ old('systolic') }}" required min="70" max="250"
                           class="w-full px-3 sm:px-4 py-3 rounded-lg border-2 border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition text-center text-2xl sm:text-3xl font-bold"
                           placeholder="120">
                    <p class="text-xs text-gray-500 mt-1 text-center">Tekanan sistolik (atas)</p>
                    @error('systolic')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">DIASTOLE (mmHg)</label>
                    <input type="number" name="diastolic" value="{{ old('diastolic') }}" required min="40" max="150"
                           class="w-full px-3 sm:px-4 py-3 rounded-lg border-2 border-teal-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition text-center text-2xl sm:text-3xl font-bold"
                           placeholder="80">
                    <p class="text-xs text-gray-500 mt-1 text-center">Tekanan diastolik (bawah)</p>
                    @error('diastolic')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Preview Category -->
            <div id="categoryPreview" class="hidden p-3 sm:p-4 rounded-lg"></div>

            <!-- Keluhan -->
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">KELUHAN</label>
                <textarea name="symptoms" rows="4"
                          class="w-full px-3 sm:px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition text-sm sm:text-base"
                          placeholder="Contoh: Pusing, sakit kepala, mual...">{{ old('symptoms') }}</textarea>
                @error('symptoms')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons - Responsive -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 pt-4">
                <a href="{{ route('patients.show', $patient) }}" class="flex-1 px-4 sm:px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center font-medium text-sm sm:text-base">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-4 sm:px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition font-medium shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const systolicInput = document.querySelector('input[name="systolic"]');
    const diastolicInput = document.querySelector('input[name="diastolic"]');
    const categoryPreview = document.getElementById('categoryPreview');

    function updateCategory() {
        const systolic = parseInt(systolicInput.value) || 0;
        const diastolic = parseInt(diastolicInput.value) || 0;

        if (systolic > 0 && diastolic > 0) {
            let category = '';
            let colorClass = '';
            let icon = '';

            if (systolic < 120 && diastolic < 80) {
                category = 'Normal';
                colorClass = 'bg-green-100 border-green-500 text-green-800';
                icon = 'fa-check-circle';
            } else if ((systolic >= 120 && systolic <= 129) || (diastolic < 80)) {
                category = 'Pra-hipertensi';
                colorClass = 'bg-blue-100 border-blue-500 text-blue-800';
                icon = 'fa-exclamation-triangle';
            } else if ((systolic >= 130 && systolic <= 139) || (diastolic >= 80 && diastolic <= 89)) {
                category = 'Hipertensi Stadium 1';
                colorClass = 'bg-yellow-100 border-yellow-500 text-yellow-800';
                icon = 'fa-exclamation-triangle';
            } else if (systolic >= 140 || diastolic >= 90) {
                category = 'Hipertensi Stadium 2';
                colorClass = 'bg-red-100 border-red-500 text-red-800';
                icon = 'fa-times-circle';
            }

            categoryPreview.className = `p-3 sm:p-4 rounded-lg border-l-4 ${colorClass}`;
            categoryPreview.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${icon} text-xl sm:text-2xl mr-3"></i>
                    <div class="flex-1">
                        <p class="font-semibold text-sm sm:text-base">Kategori: ${category}</p>
                        <p class="text-xs sm:text-sm">Tekanan darah ${systolic}/${diastolic} mmHg</p>
                    </div>
                </div>
            `;
            categoryPreview.classList.remove('hidden');
        } else {
            categoryPreview.classList.add('hidden');
        }
    }

    systolicInput.addEventListener('input', updateCategory);
    diastolicInput.addEventListener('input', updateCategory);
    updateCategory();
</script>
@endpush
