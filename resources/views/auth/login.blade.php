@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-orange-50 to-pink-50">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-paw text-white text-4xl"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Welcome Back!</h2>
            <p class="text-gray-600">Login to continue your adoption journey</p>
        </div>
        
        <!-- admin@petadopt.com &password: admin123 -->
        <!-- Login Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope text-orange-500 mr-2"></i> Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email', $rememberedEmail ?? '') }}" required autofocus
                           class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('email') border-red-500 @enderror"
                           placeholder="your@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock text-orange-500 mr-2"></i> Password
                    </label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-orange-500 rounded focus:ring-orange-500">
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-orange-500 text-white py-3 rounded-xl font-bold text-lg hover:bg-orange-600 transition shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-600 font-bold">
                        Register Now
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

