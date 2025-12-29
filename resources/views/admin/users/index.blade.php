@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-orange-500 to-pink-500 py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold text-white text-center mb-4">
            Registered Users
        </h1>
        <p class="text-white text-center text-xl">Manage and view all registered users</p>
    </div>
</div>

<!-- Search Section -->
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
            <input type="text" 
                   name="search" 
                   placeholder="Search by name or email..." 
                   value="{{ request('search') }}"
                   class="flex-1 border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:outline-none">
            
            <button type="submit" 
                    class="bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 font-semibold transition">
                <i class="fas fa-search mr-2"></i> Search
            </button>
            
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" 
                   class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 font-semibold transition">
                    <i class="fas fa-times mr-2"></i> Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Users List -->
    @if($users->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Phone
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Address
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Registered On
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $index => $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->phone }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">{{ $user->address }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  <a href="{{ route('admin.users.adoptions', $user->id) }}" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition inline-flex items-center text-sm font-semibold">
                                    <i class="fas fa-paw mr-2"></i>
                                       View Adoptions
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $users->appends(request()->query())->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
            <i class="fas fa-user-slash text-gray-300 text-8xl mb-6"></i>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">No Users Found</h3>
            <p class="text-gray-500 text-lg">Try adjusting your search criteria</p>
        </div>
    @endif
</div>
@endsection