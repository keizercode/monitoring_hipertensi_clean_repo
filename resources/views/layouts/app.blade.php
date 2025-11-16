<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tension Track')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/ppn-logo.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);
            color: white;
        }

        /* Mobile Menu Animation */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Prevent body scroll when menu open */
        body.menu-open {
            overflow: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #14B8A6;
            border-radius: 4px;
        }

        /* Touch-friendly buttons */
        @media (max-width: 768px) {
            button, a {
                min-height: 44px;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        <aside class="hidden lg:flex w-64 bg-gradient-to-b from-teal-600 to-teal-700 text-white flex-shrink-0 flex-col">
            <div class="p-6 border-b border-teal-500">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-heartbeat text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Tension</h1>
                        <p class="text-xs text-teal-200">Track</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('patients.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Daftar Pasien</span>
                </a>

                <a href="{{ route('education.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('education.*') ? 'active' : '' }}">
                    <i class="fas fa-book-medical w-5"></i>
                    <span>Edukasi</span>
                </a>

                <a href="{{ route('profile.show') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Profil</span>
                </a>
            </nav>

            <div class="p-4 border-t border-teal-500">
                <button type="button" onclick="confirmLogout()" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-500 transition text-left">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </aside>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" onclick="closeMobileMenu()"></div>

        <!-- Mobile Sidebar -->
        <aside id="mobileSidebar" class="mobile-menu fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-teal-600 to-teal-700 text-white z-50 lg:hidden flex flex-col">
            <div class="p-6 border-b border-teal-500 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-heartbeat text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Tension</h1>
                        <p class="text-xs text-teal-200">Track</p>
                    </div>
                </div>
                <button onclick="closeMobileMenu()" class="text-white hover:text-teal-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('patients.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Daftar Pasien</span>
                </a>

                <a href="{{ route('education.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('education.*') ? 'active' : '' }}">
                    <i class="fas fa-book-medical w-5"></i>
                    <span>Edukasi</span>
                </a>

                <a href="{{ route('profile.show') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg mb-2 hover:bg-teal-500 transition {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Profil</span>
                </a>
            </nav>

            <div class="p-4 border-t border-teal-500">
                <button type="button" onclick="confirmLogout()" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-500 transition text-left">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden w-full">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10 flex-shrink-0">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button onclick="toggleMobileMenu()" class="lg:hidden text-gray-600 hover:text-teal-600 transition">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 truncate">@yield('header', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-gray-800 truncate max-w-[150px]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->nip ?? 'Perawat' }}</p>
                        </div>
                        <img
                        src="{{ Auth::user()->photo && Auth::user()->photo !== 'default.png'
                        ? asset('storage/' . Auth::user()->photo)
                        : asset('default.png') }}"
                                     alt="Profile"
                             class="w-10 h-10 rounded-full object-cover border-2 border-teal-500 flex-shrink-0">
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg" id="successAlert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-700 text-sm sm:text-base flex-1">{{ session('success') }}</p>
                            <button onclick="document.getElementById('successAlert').remove()" class="ml-auto text-green-500 hover:text-green-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-1"></i>
                            <div class="flex-1">
                                @foreach($errors->all() as $error)
                                    <p class="text-red-700 text-sm sm:text-base">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-sign-out-alt text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Yakin Keluar?</h3>
                <p class="text-gray-600 text-sm sm:text-base">Anda akan keluar dari aplikasi</p>
            </div>

            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <button onclick="closeLogoutModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-medium">
                    Tidak
                </button>
                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileOverlay');
            const body = document.body;

            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
            body.classList.toggle('menu-open');
        }

        function closeMobileMenu() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileOverlay');
            const body = document.body;

            sidebar.classList.remove('active');
            overlay.classList.add('hidden');
            body.classList.remove('menu-open');
        }

        function confirmLogout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Close mobile menu when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const mobileLinks = document.querySelectorAll('#mobileSidebar a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        });

        // Auto hide success alert
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
