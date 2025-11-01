<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Tension Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-teal-50 to-blue-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl shadow-lg mb-4">
                <i class="fas fa-heartbeat text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Tension</h1>
            <p class="text-teal-600 font-medium">Track</p>
        </div>
        
        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun</h2>
            <p class="text-gray-600 mb-6">Buat akun baru untuk memulai</p>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">NAMA</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                           placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">EMAIL</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                           placeholder="email@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">PASSWORD</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                               placeholder="Minimal 6 karakter">
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">KONFIRMASI PASSWORD</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition"
                               placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white py-3 rounded-lg font-semibold hover:from-teal-600 hover:to-teal-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Sign up
                </button>
            </form>
            
            <!-- Login Link -->
            <p class="text-center text-gray-600 mt-6">
                Sudah terdaftar? 
                <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:text-teal-700">Masuk di sini</a>
            </p>
        </div>
    </div>
    
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = event.currentTarget.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>