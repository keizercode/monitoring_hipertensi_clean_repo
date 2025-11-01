@extends('layouts.app')

@section('title', 'Edit Pasien - Tension Track')
@section('header', 'Edit Data Pasien')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('patients.show', $patient) }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Data Pasien</h2>
                <p class="text-gray-600">Perbarui informasi pasien</p>
            </div>
        </div>
        
        <form action="{{ route('patients.update', $patient) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NAMA LENGKAP</label>
                <input type="text" name="name" value="{{ old('name', $patient->name) }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="Masukkan nama lengkap pasien">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- NIK -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $patient->nik) }}" required maxlength="16"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="16 digit NIK">
                @error('nik')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Usia, TB, BB -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">USIA</label>
                    <div class="relative">
                        <input type="number" name="age" value="{{ old('age', $patient->age) }}" min="0" max="150"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                               placeholder="Tahun">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">tahun</span>
                    </div>
                    @error('age')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">TINGGI BADAN</label>
                    <div class="relative">
                        <input type="number" name="height" value="{{ old('height', $patient->height) }}" min="0"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                               placeholder="cm">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">cm</span>
                    </div>
                    @error('height')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">BERAT BADAN</label>
                    <div class="relative">
                        <input type="number" name="weight" value="{{ old('weight', $patient->weight) }}" min="0"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                               placeholder="kg">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">kg</span>
                    </div>
                    @error('weight')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Riwayat Penyakit -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">RIWAYAT PENYAKIT</label>
                <textarea name="medical_history" rows="4"
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                          placeholder="Contoh: Hipertensi sejak 2021, Diabetes Tipe 2">{{ old('medical_history', $patient->medical_history) }}</textarea>
                @error('medical_history')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="flex space-x-3 pt-4">
                <a href="{{ route('patients.show', $patient) }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition font-medium shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
        
        <!-- Delete Patient -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <h3 class="text-lg font-bold text-red-600 mb-2">Zona Berbahaya</h3>
            <p class="text-gray-600 mb-4">Menghapus pasien akan menghapus semua data terkait termasuk riwayat tekanan darah.</p>
            
            <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('PERHATIAN! Tindakan ini tidak dapat dibatalkan.\n\nYakin ingin menghapus pasien {{ $patient->name }}?\n\nSemua data tekanan darah, pengingat obat, dan riwayat lainnya akan ikut terhapus.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium">
                    <i class="fas fa-trash mr-2"></i>Hapus Pasien
                </button>
            </form>
        </div>
    </div>
</div>
@endsection