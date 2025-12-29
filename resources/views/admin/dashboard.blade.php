@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">
             Admin Dashboard
        </h1>
        <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pets -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-paw text-2xl"></i>
                </div>
                <span class="text-3xl font-bold">{{ $stats['total_pets'] }}</span>
            </div>
            <p class="text-lg font-semibold">Total Pets</p>
        </div>

        <!-- Available Pets -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <span class="text-3xl font-bold">{{ $stats['available_pets'] }}</span>
            </div>
            <p class="text-lg font-semibold">Available</p>
        </div>

        <!-- Adopted Pets -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <span class="text-3xl font-bold">{{ $stats['adopted_pets'] }}</span>
            </div>
            <p class="text-lg font-semibold">Adopted</p>
        </div>

        <!-- Pending Requests -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <span class="text-3xl font-bold">{{ $stats['pending_requests'] }}</span>
            </div>
            <p class="text-lg font-semibold">Pending Requests</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Adoption Requests -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Recent Adoption Requests</h2>
                <a href="{{ route('admin.adoptions.index') }}" 
                   class="text-orange-500 hover:text-orange-600 font-semibold text-sm">
                    View All →
                </a>
            </div>

            @if($recent_requests->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_requests as $request)
                        <div class="border-l-4 border-orange-500 bg-gray-50 rounded p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    @if($request->pet->image)
                                        <img src="{{ asset('storage/' . $request->pet->image) }}" 
                                             alt="{{ $request->pet->name }}" 
                                             class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center">
                                            <span class="text-orange-600 font-bold">{{ substr($request->pet->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $request->pet->name }}</p>
                                        <p class="text-sm text-gray-600">by {{ $request->user->name }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $request->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($request->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">{{ $request->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <p class="text-lg">No recent requests</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h2>

            <div class="space-y-4">
                <a href="{{ route('admin.pets.create') }}" 
                   class="block bg-orange-500 text-white rounded-lg p-4 hover:bg-orange-600 transition">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Add New Pet</span>
                        <span>→</span>
                    </div>
                </a>

                <a href="{{ route('admin.pets.index') }}" 
                   class="block bg-blue-500 text-white rounded-lg p-4 hover:bg-blue-600 transition">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Manage All Pets</span>
                        <span>→</span>
                    </div>
                </a>

                <a href="{{ route('admin.adoptions.index') }}" 
                   class="block bg-purple-500 text-white rounded-lg p-4 hover:bg-purple-600 transition">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Review Adoption Requests</span>
                        <span>→</span>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="block bg-green-500 text-white rounded-lg p-4 hover:bg-green-600 transition">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">View Registered Users</span>
                        <span>→</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-green-600 text-3xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['approved_requests'] }}</h3>
            <p class="text-gray-600">Approved Adoptions</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['total_users'] }}</h3>
            <p class="text-gray-600">Registered Users</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-percentage text-purple-600 text-3xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">
                {{ $stats['total_pets'] > 0 ? round(($stats['adopted_pets'] / $stats['total_pets']) * 100) : 0 }}%
            </h3>
            <p class="text-gray-600">Adoption Rate</p>
        </div>
    </div>
</div>
@endsection