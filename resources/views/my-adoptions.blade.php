@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">
         My Adoption Requests
    </h1>
    
    @if($adoptions->count() > 0)
        <div class="space-y-6">
            @foreach($adoptions as $adoption)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            @if($adoption->pet->image)
                                <img src="{{ asset('storage/' . $adoption->pet->image) }}" 
                                     alt="{{ $adoption->pet->name }}" 
                                     class="w-20 h-20 rounded-lg object-cover">
                            @endif
                            <div>
                                <h3 class="text-xl font-bold">{{ $adoption->pet->name }}</h3>
                                <p class="text-gray-600">{{ ucfirst($adoption->pet->type) }} - {{ $adoption->pet->breed }}</p>
                                <p class="text-sm text-gray-500">Submitted: {{ $adoption->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <span class="px-4 py-2 rounded-full text-sm font-bold
                            {{ $adoption->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($adoption->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            <i class="fas fa-{{ $adoption->status == 'pending' ? 'clock' : ($adoption->status == 'approved' ? 'check' : 'times') }}"></i>
                            {{ ucfirst($adoption->status) }}
                        </span>
                    </div>
                    
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-600 mb-2"><strong>Your Reason:</strong></p>
                        <p class="text-gray-700 mb-4">{{ $adoption->reason }}</p>
                        
                        @if($adoption->experience)
                            <p class="text-sm text-gray-600 mb-2"><strong>Experience:</strong></p>
                            <p class="text-gray-700 mb-4">{{ $adoption->experience }}</p>
                        @endif
                        
                        @if($adoption->admin_notes)
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mt-4">
                                <p class="text-sm font-semibold text-blue-900 mb-1">Admin Notes:</p>
                                <p class="text-sm text-blue-800">{{ $adoption->admin_notes }}</p>
                            </div>
                        @endif
                        
                        @if($adoption->status == 'approved')
                            <div class="bg-green-50 border-l-4 border-green-500 p-4 mt-4">
                                <p class="text-green-800">
                                    <i class="fas fa-check-circle"></i> 
                                    <strong>Congratulations!</strong> Your adoption has been approved. We'll contact you soon!
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">No Adoption Requests Yet</h3>
            <p class="text-gray-500 mb-6">Start your adoption journey today!</p>
            <a href="{{ route('pets.browse') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Browse Pets
            </a>
        </div>
    @endif
</div>
@endsection