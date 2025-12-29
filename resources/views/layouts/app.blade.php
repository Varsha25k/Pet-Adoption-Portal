<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-40">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-paw text-white text-2xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-800">PetAdopt</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                        Home
                    </a>
                    <a href="{{ route('adoption-process') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                       Adoption Process
                    </a>
                    
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('my-adoptions') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                                My Adoptions
                            </a>
                        @endif
                        
                        <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                            My Profile
                        </a>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600">Hi, {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition font-semibold">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 font-semibold transition">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition font-semibold">
                            <i class="fas fa-user-plus mr-1"></i> Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="{{ route('adoption-process') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                        Adoption Process
                    </a>
                    
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('my-adoptions') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                                My Adoptions
                            </a>
                        @endif
                        
                        <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                            <i class="fas fa-user mr-2"></i> My Profile
                        </a>
                        
                        <span class="text-gray-600 font-semibold">Hi, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 w-full">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500 font-semibold">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 text-center">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-2xl mr-3"></i>
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">PetAdopt</h3>
                    <p class="text-gray-400">Connecting loving families with pets in need. Every adoption saves a life.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('pets.browse') }}" class="text-gray-400 hover:text-orange-500 transition">Browse Pets</a></li>
                        <li><a href="{{ route('adoption-process') }}" class="text-gray-400 hover:text-orange-500 transition">Adoption Process</a></li>
                        
                        @guest
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-orange-500 transition">Register</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-orange-500 transition">Login</a></li>
                        @endguest
                        
                        @auth
                            <li><a href="{{ route('my-adoptions') }}" class="text-gray-400 hover:text-orange-500 transition">My Adoptions</a></li>
                            <li><a href="{{ route('profile.show') }}" class="text-gray-400 hover:text-orange-500 transition">My Profile</a></li>
                        @endauth
                    </ul>
                </div>

            

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@petadopt.com</li>
                        <li>Phone: +92 300 1234567</li>
                        <li>Location: Karachi, Pakistan</li>
                    </ul>
                </div>
                
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 PetAdopt. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>