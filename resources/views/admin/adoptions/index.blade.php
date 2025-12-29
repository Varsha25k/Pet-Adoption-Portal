@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Adoption Requests Management</h1>
    
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-800">User</th>
                    <th class="px-6 py-3 text-left text-gray-800">Pet</th>
                    <th class="px-6 py-3 text-left text-gray-800">Contact</th>
                    <th class="px-6 py-3 text-left text-gray-800">Status</th>
                    <th class="px-6 py-3 text-left text-gray-800">Date</th>
                    <th class="px-6 py-3 text-left text-gray-800">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($adoptions as $adoption)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $adoption->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $adoption->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($adoption->pet->image)
                                    <img src="{{ asset('storage/' . $adoption->pet->image) }}" 
                                         alt="{{ $adoption->pet->name }}" 
                                         class="w-12 h-12 rounded-lg object-cover">
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $adoption->pet->name }}</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst($adoption->pet->type) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-800">{{ $adoption->user->phone }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $adoption->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($adoption->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($adoption->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $adoption->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.adoptions.show', $adoption) }}" 
                               class="text-blue-600 hover:underline font-medium hover:shadow-lg">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $adoptions->links() }}
    </div>
</div>
@endsection