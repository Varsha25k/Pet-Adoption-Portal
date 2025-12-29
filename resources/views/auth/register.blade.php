@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-orange-50 to-pink-50">
    <div class="max-w-2xl w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-paw text-white text-4xl"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Join Our Family!</h2>
            <p class="text-gray-600">Create an account to start adopting pets</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-user text-orange-500 mr-2"></i> Full Name *
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('name') border-red-500 @enderror"
                               placeholder="John Doe">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-envelope text-orange-500 mr-2"></i> Email *
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('email') border-red-500 @enderror"
                               placeholder="your@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-phone text-orange-500 mr-2"></i> Phone Number *
                        </label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('phone') border-red-500 @enderror"
                               placeholder="03001234567">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-lock text-orange-500 mr-2"></i> Password *
                        </label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('password') border-red-500 @enderror"
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-lock text-orange-500 mr-2"></i> Confirm Password *
                        </label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-orange-500 mr-2"></i> Full Address *
                    </label>
                    <textarea name="address" rows="3" required
                              class="w-full px-4 py-3 border-2 rounded-xl focus:border-orange-500 focus:outline-none @error('address') border-red-500 @enderror"
                              placeholder="Your complete address">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full mt-6 bg-orange-500 text-white py-3 rounded-xl font-bold text-lg hover:bg-orange-600 transition shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i> Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-bold">
                        Login Here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection