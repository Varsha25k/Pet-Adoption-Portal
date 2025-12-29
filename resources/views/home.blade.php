@extends('layouts.app')

@section('content')
<!-- Hero Section --> 
<div class="relative bg-cover bg-center h-[600px]" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?w=1920');">
    <div class="container mx-auto px-4 h-full flex items-center">
        <div class="max-w-2xl">
            <h1 class="text-6xl font-bold mb-4 text-white">Adopt a Pet Today</h1>
            <p class="text-2xl mb-8 text-white">Give a homeless animal a second chance at life</p>
            <a href="{{ route('pets.browse') }}" 
               class="bg-orange-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-orange-600 inline-block">
                Browse Pets
            </a>
        </div>
    </div>
</div>

<!-- Why Adopt Section -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Why Adopt From Us?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-heart text-4xl text-orange-500"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Save a Life</h3>
                <p class="text-gray-600">Every adoption saves a life and makes room for another animal in need</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shield-alt text-4xl text-orange-500"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Health Checked</h3>
                <p class="text-gray-600">All our pets are vaccinated, health screened, and ready for adoption</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-hands-helping text-4xl text-orange-500"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Ongoing Support</h3>
                <p class="text-gray-600">We provide lifetime support and guidance for all adopters</p>
            </div>
        </div>
    </div>
</div>

<!-- Pet Care Tips Section -->
<div class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Pet Care & Adoption Tips</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tips Card 1 -->
            <div class="bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="p-8 text-white">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-hand-holding-heart text-3xl text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Adoption Tips</h3>
                    <p class="mb-6">Learn how to choose the right pet for your lifestyle and family</p>
                    <button onclick="showModal('adopt-tips')" 
                            class="bg-white text-pink-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Learn More
                    </button>
                </div>
            </div>
            
            <!-- Tips Card 2 -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="p-8 text-white">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-stethoscope text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Care Essentials</h3>
                    <p class="mb-6">Essential tips for keeping your new pet healthy and happy</p>
                    <button onclick="showModal('care-essentials')" 
                            class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Learn More
                    </button>
                </div>
            </div>
            
            <!-- Tips Card 3 -->
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="p-8 text-white">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-home text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Home Preparation</h3>
                    <p class="mb-6">Get your home ready for your new furry family member</p>
                    <button onclick="showModal('home-prep')" 
                            class="bg-white text-purple-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Learn More
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div id="adopt-tips" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold">Tips for Adopting a Pet</h3>
                <button onclick="closeModal('adopt-tips')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-3xl"></i>
                </button>
            </div>
            <div class="space-y-6 text-gray-700">
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Research Different Breeds</h4>
                    <p>Learn about different pet breeds and their characteristics to find the best match for your lifestyle.</p>
                </div>
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Consider Your Living Space</h4>
                    <p>Make sure your home is suitable for the size and energy level of the pet you want to adopt.</p>
                </div>
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Budget for Pet Expenses</h4>
                    <p>Factor in costs like food, veterinary care, grooming, and supplies before adopting.</p>
                </div>
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Meet the Pet First</h4>
                    <p>Spend time with the pet before adoption to ensure you're compatible.</p>
                </div>
                <div class="border-l-4 border-orange-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Be Patient</h4>
                    <p>Give your new pet time to adjust to their new home and build trust with you.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="care-essentials" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold">Pet Care Essentials</h3>
                <button onclick="closeModal('care-essentials')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-3xl"></i>
                </button>
            </div>
            <div class="space-y-6 text-gray-700">
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Nutrition</h4>
                    <p>Provide high-quality food appropriate for your pet's age, size, and health needs. Always ensure fresh water is available.</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Regular Vet Visits</h4>
                    <p>Schedule annual check-ups and keep vaccinations up to date. Early detection of health issues is crucial.</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Exercise and Play</h4>
                    <p>Provide daily exercise and mental stimulation through walks, play sessions, and interactive toys.</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Grooming</h4>
                    <p>Regular brushing, nail trimming, and bathing keep your pet healthy and comfortable.</p>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Love and Attention</h4>
                    <p>Spend quality time with your pet daily. Build a strong bond through positive interactions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="home-prep" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold">Preparing Your Home</h3>
                <button onclick="closeModal('home-prep')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-3xl"></i>
                </button>
            </div>
            <div class="space-y-6 text-gray-700">
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Pet-Proof Your Space</h4>
                    <p>Remove hazards like toxic plants, small objects, and exposed wires. Secure cabinets with cleaning supplies.</p>
                </div>
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Essential Supplies</h4>
                    <p>Get food/water bowls, a comfortable bed, collar with ID tag, leash, toys, and grooming supplies.</p>
                </div>
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Designate Safe Spaces</h4>
                    <p>Create a quiet area where your pet can retreat when feeling overwhelmed or tired.</p>
                </div>
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Set Up Feeding Area</h4>
                    <p>Choose a consistent location for food and water bowls away from high-traffic areas.</p>
                </div>
                <div class="border-l-4 border-purple-500 pl-4">
                    <h4 class="font-bold text-xl mb-2">Plan for Emergencies</h4>
                    <p>Know the location of the nearest 24-hour vet clinic and keep important contact numbers handy.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.querySelectorAll('.fixed').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal(this.id);
        }
    });
});
</script>
@endsection