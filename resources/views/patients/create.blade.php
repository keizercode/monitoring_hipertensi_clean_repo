@extends('layouts.app')

@section('title', 'Tambah Pasien - Tension Track')
@section('header', 'Tambah Pasien Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('patients.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pasien</h2>
                <p class="text-gray-600">Lengkapi data pasien baru</p>
            </div>
        </div>
        
        <form action="{{ route('patients.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NAMA LENGKAP</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="Masukkan nama lengkap pasien">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- NIK -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
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
                        <input type="number" name="age" value="{{ old('age') }}" min="0" max="150"
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
                        <input type="number" name="height" value="{{ old('height') }}" min="0"
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
                        <input type="number" name="weight" value="{{ old('weight') }}" min="0"
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
                          placeholder="Contoh: Hipertensi sejak 2021, Diabetes Tipe 2">{{ old('medical_history') }}</textarea>
                @error('medical_history')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="flex space-x-3 pt-4">
                <a href="{{ route('patients.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition font-medium shadow-lg hover:shadow-xl">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection