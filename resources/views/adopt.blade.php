@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
            <h1 class="text-3xl font-bold mb-6">Adopt {{ $pet->name }}</h1>
            
            <!-- Pet Summary -->
            <div class="flex items-center gap-4 mb-8 p-4 bg-gray-50 rounded-lg">
                @if($pet->image)
                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" 
                         class="w-24 h-24 rounded-lg object-cover">
                @endif
                <div>
                    <h3 class="text-xl font-bold">{{ $pet->name }}</h3>
                    <p class="text-gray-600">{{ ucfirst($pet->type) }} - {{ $pet->breed }}</p>
                    <p class="text-gray-500">{{ $pet->age }} years old</p>
                </div>
            </div>
            
            <!-- Adoption Form -->
            <form method="POST" action="{{ route('adopt.store') }}">
                @csrf
                <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Why do you want to adopt {{ $pet->name }}? * (Minimum 50 characters)
                    </label>
                    <textarea name="reason" required rows="5" 
                              class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('reason') border-red-500 @enderror"
                              placeholder="Tell us why you want to adopt this pet and how you plan to care for them...">{{ old('reason') }}</textarea>
                    @error('reason')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Previous Pet Experience (Optional)
                    </label>
                    <textarea name="experience" rows="4" 
                              class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                              placeholder="Share your experience with pets, if any...">{{ old('experience') }}</textarea>
                </div>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Note:</strong> Your request will be reviewed by our admin. We'll contact you once it's approved.
                    </p>
                </div>
                
                <div class="flex gap-4">
                    <a href="{{ route('pet.show', $pet) }}" 
                       class="flex-1 text-center bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold">
                        Submit Adoption Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection