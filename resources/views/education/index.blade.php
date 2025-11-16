@extends('layouts.app')

@section('title', 'Edukasi - Tension Track')
@section('header', 'Edukasi Kesehatan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Edukasi Hipertensi</h2>
    <p class="text-gray-600">Panduan lengkap untuk mengelola tekanan darah</p>
</div>

<!-- Hero Banner -->
<div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-xl shadow-xl p-8 mb-6 text-white">
    <div class="flex items-center">
        <div class="flex-1">
            <h3 class="text-2xl font-bold mb-2">Jaga Kesehatan Anda</h3>
            <p class="text-teal-100 mb-4">Pelajari cara mengelola hipertensi dengan gaya hidup sehat</p>
            <div class="flex space-x-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Diet Sehat</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Olahraga Rutin</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Hidrasi Cukup</span>
                </div>
            </div>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-heartbeat text-white text-8xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Diet Rendah Garam -->
<div class="mb-6">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-3">
            <i class="fas fa-utensils text-orange-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Diet Rendah Garam</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($dietContents as $content)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-start mb-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-{{ $content->icon ?? 'info-circle' }} text-orange-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 flex-1">{{ $content->title }}</h4>
                </div>
                <p class="text-gray-600 text-sm">{{ Str::limit($content->content, 150) }}</p>
                <a href="{{ route('education.show', $content) }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium mt-3 text-sm">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @empty
            <p class="text-gray-500">Diet rendah garam penting untuk membantu menurunkan tekanan darah karena garam dapat menyebabkan tubuh menahan cairan dan meningkatkan beban kerja jantung. Pasien dianjurkan membatasi konsumsi makanan tinggi natrium seperti makanan instan, keripik, makanan kaleng, dan bumbu penyedap.</p>
        @endforelse
    </div>
</div>

<!-- Olahraga -->
<div class="mb-6">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
            <i class="fas fa-running text-blue-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Olahraga & Aktivitas Fisik</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($exerciseContents as $content)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-start mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-{{ $content->icon ?? 'dumbbell' }} text-blue-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 flex-1">{{ $content->title }}</h4>
                </div>
                <p class="text-gray-600 text-sm">{{ Str::limit($content->content, 150) }}</p>
                <a href="{{ route('education.show', $content) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium mt-3 text-sm">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @empty
            <p class="text-gray-500">Aktivitas fisik rutin dapat membantu memperbaiki aliran darah, menurunkan tekanan darah, serta menjaga berat badan ideal. Pasien dianjurkan melakukan olahraga ringan–sedang seperti jalan kaki 30 menit per hari, 5 kali seminggu.</p>
        @endforelse
    </div>
</div>

<!-- Hidrasi -->
<div class="mb-6">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mr-3">
            <i class="fas fa-glass-water text-cyan-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Minum Air yang Cukup</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($hydrationContents as $content)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-start mb-4">
                    <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-{{ $content->icon ?? 'tint' }} text-cyan-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 flex-1">{{ $content->title }}</h4>
                </div>
                <p class="text-gray-600 text-sm">{{ Str::limit($content->content, 150) }}</p>
                <a href="{{ route('education.show', $content) }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mt-3 text-sm">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @empty
            <p class="text-gray-500">Memenuhi kebutuhan cairan harian membantu menjaga fungsi organ tubuh dan mencegah dehidrasi yang dapat mempengaruhi tekanan darah. Pasien dianjurkan minum air 6–8 gelas per hari atau disesuaikan dengan kondisi kesehatan.</p>
        @endforelse
    </div>
</div>

<!-- Obat -->
<div class="mb-6">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
            <i class="fas fa-pills text-purple-600 text-xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Pengobatan & Konsultasi</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($medicationContents as $content)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-start mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-{{ $content->icon ?? 'capsules' }} text-purple-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 flex-1">{{ $content->title }}</h4>
                </div>
                <p class="text-gray-600 text-sm">{{ Str::limit($content->content, 150) }}</p>
                <a href="{{ route('education.show', $content) }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium mt-3 text-sm">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @empty
            <p class="text-gray-500">Penderita hipertensi perlu minum obat secara teratur sesuai anjuran dokter serta melakukan kontrol rutin untuk memantau perkembangan tekanan darah. Konsultasi dilakukan untuk mengevaluasi terapi dan menyesuaikan pengobatan bila diperlukan.</p>
        @endforelse
    </div>
</div>
@endsection
