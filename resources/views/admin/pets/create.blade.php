@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Add New Pet</h1>
        
        <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-lg shadow-md p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Pet Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full border rounded-lg px-4 py-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Type *</label>
                    <select name="type" required
                            class="w-full border rounded-lg px-4 py-2 @error('type') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="dog" {{ old('type') == 'dog' ? 'selected' : '' }}>Dog</option>
                        <option value="cat" {{ old('type') == 'cat' ? 'selected' : '' }}>Cat</option>
                        <option value="bird" {{ old('type') == 'bird' ? 'selected' : '' }}>Bird</option>
                        <option value="rabbit" {{ old('type') == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Breed *</label>
                    <input type="text" name="breed" value="{{ old('breed') }}" required
                           class="w-full border rounded-lg px-4 py-2 @error('breed') border-red-500 @enderror">
                    @error('breed')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Age (years) *</label>
                    <input type="number" name="age" value="{{ old('age') }}" min="0" max="30" required
                           class="w-full border rounded-lg px-4 py-2 @error('age') border-red-500 @enderror">
                    @error('age')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Gender *</label>
                    <select name="gender" required
                            class="w-full border rounded-lg px-4 py-2 @error('gender') border-red-500 @enderror">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Size *</label>
                    <select name="size" required
                            class="w-full border rounded-lg px-4 py-2 @error('size') border-red-500 @enderror">
                        <option value="">Select Size</option>
                        <option value="small" {{ old('size') == 'small' ? 'selected' : '' }}>Small</option>
                        <option value="medium" {{ old('size') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="large" {{ old('size') == 'large' ? 'selected' : '' }}>Large</option>
                    </select>
                    @error('size')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Location *</label>
                <input type="text" name="location" value="{{ old('location') }}" required
                       placeholder="e.g., Karachi, Pakistan"
                       class="w-full border rounded-lg px-4 py-2 @error('location') border-red-500 @enderror">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Description *</label>
                <textarea name="description" rows="4" required
                          class="w-full border rounded-lg px-4 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium mb-2">Pet Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full border rounded-lg px-4 py-2 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-6 flex gap-6">
                <label class="flex items-center">
                    <input type="checkbox" name="vaccinated" value="1" {{ old('vaccinated') ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm">Vaccinated</span>
                </label>
                
                <label class="flex items-center">
                    <input type="checkbox" name="trained" value="1" {{ old('trained') ? 'checked' : '' }}
                           class="mr-2">
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
                    Add Pet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection