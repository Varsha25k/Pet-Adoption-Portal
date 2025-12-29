@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Back Button -->
    <a href="{{ route('pets.browse') }}" class="inline-flex items-center text-orange-500 hover:text-orange-600 mb-6 font-semibold">
        <i class="fas fa-arrow-left mr-2"></i> Back to All Pets
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Pet Image -->
        <div>
            @if($pet->image)
                <img src="{{ asset('storage/' . $pet->image) }}" 
                     alt="{{ $pet->name }}" 
                     class="w-full h-[500px] object-cover rounded-3xl shadow-2xl">
            @else
                <div class="w-full h-[500px] bg-gradient-to-br from-orange-400 to-pink-500 rounded-3xl shadow-2xl flex items-center justify-center">
                    <i class="fas fa-paw text-white text-9xl"></i>
                </div>
            @endif
        </div>

        <!-- Pet Details -->
        <div>
            <div class="bg-white rounded-3xl shadow-lg p-8">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-4xl font-bold text-gray-800">{{ $pet->name }}</h1>
                    <span class="px-4 py-2 bg-orange-100 text-orange-600 rounded-full font-bold">
                        {{ ucfirst($pet->type) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-sm mb-1">Breed</p>
                        <p class="font-bold text-lg">{{ $pet->breed }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-sm mb-1">Age</p>
                        <p class="font-bold text-lg">{{ $pet->age }} {{ $pet->age == 1 ? 'Year' : 'Years' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-sm mb-1">Gender</p>
                        <p class="font-bold text-lg {{ $pet->gender == 'male' ? 'text-blue-600' : 'text-pink-600' }}">
                            {{ ucfirst($pet->gender) }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-sm mb-1">Size</p>
                        <p class="font-bold text-lg">{{ ucfirst($pet->size) }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-sm mb-1">Location</p>
                        <p class="font-bold text-lg">{{ $pet->location }}</p>
                    </div>
                </div>

                <!-- Health & Training Status -->
                <div class="flex gap-3 mb-6">
                    @if($pet->vaccinated)
                        <span class="flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold">
                            <i class="fas fa-check-circle mr-2"></i> Vaccinated
                        </span>
                    @endif
                    @if($pet->trained)
                        <span class="flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-full font-semibold">
                            Trained
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-xl font-bold mb-3">About {{ $pet->name }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $pet->description }}</p>
                </div>

                <!-- Adoption Status & Button -->
                @if($pet->status == 'available')
                    @auth
                        <a href="{{ route('adopt.create', $pet) }}" 
                           class="block w-full bg-orange-500 text-white text-center px-8 py-4 rounded-xl hover:bg-orange-600 transition font-bold text-lg shadow-lg">
                            <i class="fas fa-heart mr-2"></i> Adopt {{ $pet->name }}
                        </a>
                        <a href="{{ route('adoption-process') }}" 
                           class="block w-full bg-gray-200 text-gray-700 text-center px-8 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                              Learn About Adoption Process
                        </a>
                    @else
                        <div class="text-center">
                            <p class="text-gray-600 mb-4">Please login to adopt this pet</p>
                            <a href="{{ route('login') }}" 
                               class="inline-block bg-orange-500 text-white px-8 py-4 rounded-xl hover:bg-orange-600 transition font-bold">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login to Adopt
                            </a>
                        </div>
                    @endauth
                @else
                    <div class="bg-gray-100 text-gray-700 text-center px-8 py-4 rounded-xl font-bold text-lg">
                        <i class="fas fa-check-circle mr-2"></i> Already Adopted
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Similar Pets -->
    @if(isset($similar_pets) && $similar_pets->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold mb-8">Similar Pets You Might Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($similar_pets as $similar)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($similar->image)
                        <img src="{{ asset('storage/' . $similar->image) }}" 
                             alt="{{ $similar->name }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-pink-500 flex items-center justify-center">
                            <i class="fas fa-paw text-white text-5xl"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $similar->name }}</h3>
                        <p class="text-gray-600 mb-3">{{ $similar->breed }}</p>
                        <a href="{{ route('pet.show', $similar) }}" 
                           class="block text-center bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection