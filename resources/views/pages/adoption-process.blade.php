@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-orange-500 to-pink-500 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold text-white text-center mb-4">
            Adoption Guide</h1>
        <p class="text-white text-center text-xl">
            Everything you need to know about adopting and caring for your new companion</p>
    </div>
</div>

<!-- Content Section -->
<div class="container mx-auto px-4 py-12">
    <div class="mt-16">
        <h2 class="text-3xl font-bold mb-8">Complete Adoption Guide</h2>
        
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h3 class="text-2xl font-bold mb-4">Before You Adopt</h3>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <span>Assess your lifestyle and determine which pet would be the best fit</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <span>Consider the long-term commitment - pets can live 10-20 years</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <span>Calculate expected annual costs including food, vet care, and supplies</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <span>Ensure all family members are on board with the adoption</span>
                </li>
            </ul>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-4">The First 30 Days</h3>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                    <span>Schedule a vet appointment within the first week</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                    <span>Establish a routine for feeding, walks, and playtime</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                    <span>Begin training and socialization gradually</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                    <span>Be patient - adjustment can take several weeks</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection