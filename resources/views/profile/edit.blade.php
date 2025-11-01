@extends('layouts.app')

@section('title', 'Edit Profil - Tension Track')
@section('header', 'Edit Profil')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('profile.show') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Profil</h2>
                <p class="text-gray-600">Perbarui informasi profil Anda</p>
            </div>
        </div>
        
        <!-- Upload Foto -->
        <div class="mb-8 text-center">
            <div class="relative inline-block">
                <img id="preview" 
                     src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200&background=14B8A6&color=fff' }}" 
                     alt="Profile" 
                     class="w-32 h-32 rounded-full object-cover border-4 border-teal-500 shadow-lg mx-auto">
                <label for="photoInput" class="absolute bottom-0 right-0 w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-teal-600 transition shadow-lg">
                    <i class="fas fa-camera text-white"></i>
                </label>
            </div>
            <div class="mt-4 space-x-3">
                <label for="photoInput" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg cursor-pointer hover:bg-teal-200 transition text-sm">
                    <i class="fas fa-upload mr-2"></i>Pilih dari Galeri
                </label>
            </div>
        </div>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">
            
            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NAMA LENGKAP</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">EMAIL</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- NIP -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', Auth::user()->nip) }}"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                       placeholder="Masukkan NIP (opsional)">
                @error('nip')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Buttons -->
            <div class="flex space-x-3 pt-4">
                <a href="{{ route('profile.show') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition font-medium shadow-lg">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
        
        <!-- Change Password Section -->
        <div class="mt-8 pt-8 border-t border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Ubah Password</h3>
            
            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">PASSWORD SAAT INI</label>
                    <input type="password" name="current_password" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">PASSWORD BARU</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">KONFIRMASI PASSWORD BARU</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition">
                </div>
                
                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition font-medium shadow-lg">
                    <i class="fas fa-key mr-2"></i>Ubah Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush