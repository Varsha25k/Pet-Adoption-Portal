@extends('layouts.app')

@section('content')

@if(request()->cookie('last_visited_pet'))
    <div class="container mx-auto px-4">
        <p class="text-gray-700">
            <span class="font-semibold">Recently Viewed:</span> 
            {{ request()->cookie('last_visited_pet_name', 'A Pet') }}
            <a href="{{ route('pet.show', request()->cookie('last_visited_pet')) }}" 
               class="text-red-600 hover:underline ml-4">
                View Again
            </a>
        </p>
    </div>
@endif


<!-- Search & Filter Section -->
<div class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-8">Find Your Perfect Match</h2>
    
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
        <form method="GET" action="{{ route('pets.browse') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <input type="text" name="search" placeholder="Search by name..." 
                   value="{{ request('search') }}"
                   class="border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:outline-none">
            
            <select name="type" class="border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:outline-none">
                <option value="">All Types</option>
                <option value="dog" {{ request('type') == 'dog' ? 'selected' : '' }}>Dogs</option>
                <option value="cat" {{ request('type') == 'cat' ? 'selected' : '' }}>Cats</option>
                <option value="bird" {{ request('type') == 'bird' ? 'selected' : '' }}>Birds</option>
                <option value="rabbit" {{ request('type') == 'rabbit' ? 'selected' : '' }}>Rabbits</option>
                <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            
            <select name="size" class="border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:outline-none">
                <option value="">All Sizes</option>
                <option value="small" {{ request('size') == 'small' ? 'selected' : '' }}>Small</option>
                <option value="medium" {{ request('size') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="large" {{ request('size') == 'large' ? 'selected' : '' }}>Large</option>
            </select>
            
            <select name="gender" class="border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:outline-none">
                <option value="">All Genders</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            
            <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 font-semibold">
                <i class="fas fa-search mr-2"></i> Search
            </button>
        </form>
    </div>

    <!-- Pets Grid -->
    @if($pets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-12">
            @foreach($pets as $pet)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative">
                        @if($pet->image)
                            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" 
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-orange-400 to-pink-500 flex items-center justify-center">
                                <i class="fas fa-paw text-white text-7xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full shadow-md">
                            <span class="text-orange-500 font-bold">{{ ucfirst($pet->type) }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $pet->name }}</h3>
                        
                        <div class="space-y-2 text-gray-600 mb-4">
                            <p class="flex items-center"> 
                                {{ $pet->breed }}
                            </p>
                            <p class="flex items-center"> 
                                {{ $pet->age }} {{ $pet->age == 1 ? 'year' : 'years' }}
                            </p>
                            <p class="flex items-center">
                                {{ $pet->location }}
                            </p>
                        </div>
                        
                        <div class="flex gap-2 mb-4 flex-wrap">
                            <span class="text-xs px-3 py-1 rounded-full {{ $pet->gender == 'male' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ ucfirst($pet->gender) }}
                            </span>
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                {{ ucfirst($pet->size) }}
                            </span>
                            @if($pet->vaccinated)
                                <span class="text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-full">
                                    Vaccinated
                                </span>
                            @endif
                        </div>
                        
                        <a href="{{ route('pet.show', $pet) }}" 
                           class="block text-center bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 font-semibold transition">
                            Learn More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
            <i class="fas fa-search text-gray-300 text-8xl mb-6"></i>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">No Pets Found</h3>
            <p class="text-gray-500 text-lg">Try adjusting your search filters or check back later</p>
        </div>
    @endif
</div>
@endsection