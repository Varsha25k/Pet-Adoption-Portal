@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold mb-6">Change Password</h1>

            <form method="POST" action="{{ route('profile.change-password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Current Password</label>
                    <input type="password" name="current_password" required
                           class="w-full border rounded-lg px-4 py-3 @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">New Password</label>
                    <input type="password" name="new_password" required
                           class="w-full border rounded-lg px-4 py-3 @error('new_password') border-red-500 @enderror">
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Minimum 6 characters</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" required
                           class="w-full border rounded-lg px-4 py-3">
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('profile.show') }}" 
                       class="flex-1 text-center bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection