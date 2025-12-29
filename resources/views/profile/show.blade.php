@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
                <a href="{{ route('profile.edit') }}" 
                   class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">
                    Edit Profile
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Full Name</p>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Email Address</p>
                    <p class="font-semibold text-lg">{{ $user->email }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Phone Number</p>
                    <p class="font-semibold text-lg">{{ $user->phone }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Member Since</p>
                    <p class="font-semibold text-lg">{{ $user->created_at->format('M d, Y') }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                    <p class="text-sm text-gray-600 mb-1">Address</p>
                    <p class="font-semibold text-lg">{{ $user->address }}</p>
                </div>
            </div>

            <div class="mt-8 border-t pt-6">
                <h3 class="text-xl font-bold mb-4">Security</h3>
                <a href="{{ route('profile.change-password') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Change Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection