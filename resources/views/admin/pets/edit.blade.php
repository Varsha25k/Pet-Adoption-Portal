@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Edit Pet: {{ $pet->name }}</h1>
        
        <form action="{{ route('admin.pets.update', $pet) }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-lg shadow-md p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Pet Name *</label>
                    <input type="text" name="name" value="{{ old('name', $pet->name) }}" required
                           class="w-full border rounded-lg px-4 py-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Type *</label>
                    <select name="type" required
                            class="w-full border rounded-lg px-4 py-2 @error('type') border-red-500 @enderror">
                        <option value="dog" {{ old('type', $pet->type) == 'dog' ? 'selected' : '' }}>Dog</option>
                        <option value="cat" {{ old('type', $pet->type) == 'cat' ? 'selected' : '' }}>Cat</option>
                        <option value="bird" {{ old('type', $pet->type) == 'bird' ? 'selected' : '' }}>Bird</option>
                        <option value="rabbit" {{ old('type', $pet->type) == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                        <option value="other" {{ old('type', $pet->type) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Breed *</label>
                    <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}" required
                           class="w-full border rounded-lg px-4 py-2">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Age (years) *</label>
                    <input type="number" name="age" value="{{ old('age', $pet->age) }}" min="0" max="30" required
                           class="w-full border rounded-lg px-4 py-2">
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Gender *</label>
                    <select name="gender" required class="w-full border rounded-lg px-4 py-2">
                        <option value="male" {{ old('gender', $pet->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $pet->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Size *</label>
                    <select name="size" required class="w-full border rounded-lg px-4 py-2">
                        <option value="small" {{ old('size', $pet->size) == 'small' ? 'selected' : '' }}>Small</option>
                        <option value="medium" {{ old('size', $pet->size) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="large" {{ old('size', $pet->size) == 'large' ? 'selected' : '' }}>Large</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Status *</label>
                    <select name="status" required class="w-full border rounded-lg px-4 py-2">
                        <option value="available" {{ old('status', $pet->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="adopted" {{ old('status', $pet->status) == 'adopted' ? 'selected' : '' }}>Adopted</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Location *</label>
                <input type="text" name="location" value="{{ old('location', $pet->location) }}" required
                       class="w-full border rounded-lg px-4 py-2">
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Description *</label>
                <textarea name="description" rows="4" required
                          class="w-full border rounded-lg px-4 py-2">{{ old('description', $pet->description) }}</textarea>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Pet Image</label>
                @if($pet->image)
                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" 
                         class="w-32 h-32 rounded-lg object-cover mb-3">
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
            
            <div class="mt-6 flex gap-6">
                <label class="flex items-center">
                    <input type="checkbox" name="vaccinated" value="1" 
                           {{ old('vaccinated', $pet->vaccinated) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm">Vaccinated</span>
                </label>
                
                <label class="flex items-center">
                    <input type="checkbox" name="trained" value="1" 
                           {{ old('trained', $pet->trained) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm">Trained</span>
                </label>
            </div>
            
            <div class="mt-8 flex gap-4">
                <a href="{{ route('admin.pets.index') }}" 
                   class="flex-1 text-center bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold">
                    Update Pet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection