@extends('layouts.app')

@section('title', 'Profil - Tension Track')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-8 text-white">
            <div class="flex items-center space-x-6">
                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200&background=14B8A6&color=fff' }}" 
                     alt="Profile" 
                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                <div>
                    <h2 class="text-3xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-teal-100">{{ Auth::user()->email }}</p>
                    @if(Auth::user()->nip)
                        <p class="text-teal-100 mt-1">
                            <i class="fas fa-id-card mr-2"></i>NIP: {{ Auth::user()->nip }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Informasi Profil</h3>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                    <i class="fas fa-edit mr-2"></i>Edit Profil
                </a>
            </div>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Email</p>
                    <p class="font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">NIP</p>
                    <p class="font-semibold text-gray-800">{{ Auth::user()->nip ?? '-' }}</p>
                </div>
                
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Terdaftar Sejak</p>
                    <p class="font-semibold text-gray-800">{{ Auth::user()->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
