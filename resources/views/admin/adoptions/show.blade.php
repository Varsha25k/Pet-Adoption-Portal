@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Adoption Request Details</h1>
        
        <!-- User & Pet Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- User Info -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-user text-blue-600"></i> <span class="text-blue-600">Applicant Information</span>
                </h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Phone</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->user->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Address</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->user->address }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Request Date</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Pet Info -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold mb-4">
                    <i class="fas fa-paw text-purple-600"></i> <span class="text-purple-600">Pet Information</span>
                </h3>
                @if($adoption->pet->image)
                    <img src="{{ asset('storage/' . $adoption->pet->image) }}" 
                         alt="{{ $adoption->pet->name }}" 
                         class="w-full h-48 rounded-lg object-cover mb-4">
                @endif
                <div class="space-y-2">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->pet->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Type & Breed</p>
                        <p class="font-semibold text-gray-800">{{ ucfirst($adoption->pet->type) }} - {{ $adoption->pet->breed }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Age</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->pet->age }} years old</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Location</p>
                        <p class="font-semibold text-gray-800">{{ $adoption->pet->location }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Adoption Reason -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 hover:shadow-lg transition">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Why They Want to Adopt</h3>
            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $adoption->reason }}</p>
        </div>
        
        <!-- Previous Experience -->
        @if($adoption->experience)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 hover:shadow-lg transition">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Previous Pet Experience</h3>
                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $adoption->experience }}</p>
            </div>
        @endif
        
        <!-- Update Status Form -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-bold mb-4">
                <i class="fas fa-clipboard-check text-green-600"></i> <span class="text-green-600">Update Status</span>
            </h3>
            
            <form action="{{ route('admin.adoptions.updatestatus', $adoption) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2 text-gray-800">Status *</label>
                    <select name="status" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
                        <option value="pending" {{ $adoption->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="approved" {{ $adoption->status == 'approved' ? 'selected' : '' }}>
                            Approved ✓
                        </option>
                        <option value="rejected" {{ $adoption->status == 'rejected' ? 'selected' : '' }}>
                            Rejected ✗
                        </option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2 text-gray-800">Admin Notes</label>
                    <textarea name="admin_notes" rows="4" 
                              placeholder="Add notes for the applicant (optional)..."
                              class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">{{ old('admin_notes', $adoption->admin_notes) }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">These notes will be visible to the applicant</p>
                </div>
                
                @if($adoption->status == 'approved')
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <p class="text-green-800">
                            <i class="fas fa-check-circle"></i> 
                            <strong>Approved on:</strong> {{ $adoption->approved_at ? $adoption->approved_at->format('M d, Y h:i A') : 'N/A' }}
                        </p>
                    </div>
                @endif
                
                <div class="flex gap-4">
                    <a href="{{ route('admin.adoptions.index') }}" 
                       class="flex-1 text-center bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-medium">
                        Back to List
                    </a>
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection