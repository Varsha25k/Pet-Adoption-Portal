<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Check if user wants to browse pets
        $showPets = $request->has('browse') || 
                    $request->filled('search') || 
                    $request->filled('type') || 
                    $request->filled('size') || 
                    $request->filled('gender') ||
                    $request->has('show_all');
        
        // Only query pets if user is browsing
        if ($showPets) {
            $query = Pet::where('status', 'available');

            // Search by name or breed
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('breed', 'like', "%{$search}%");
                });
            }

            // Filter by type
            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            // Filter by size
            if ($request->filled('size')) {
                $query->where('size', $request->size);
            }

            // Filter by gender
            if ($request->filled('gender')) {
                $query->where('gender', $request->gender);
            }

             $pets = $query->latest()->paginate(8);
        } else {
            // Empty collection when not browsing
            $pets = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 8);
        }

        return view('home', compact('pets', 'showPets'));
    }
     
    // Show pet details
    public function show(Pet $pet)
    {
        Cookie::queue('last_visited_pet', $pet->id, 60 * 24 * 7);
        Cookie::queue('last_visited_pet_name', $pet->name, 60 * 24 * 7);
        
        $similar_pets = Pet::where('type', $pet->type)
                           ->where('id', '!=', $pet->id)
                           ->where('status', 'available')
                           ->inRandomOrder()
                           ->take(4)
                           ->get();

        return view('pet-details', compact('pet', 'similar_pets'));
    }

    public function browse(Request $request)
    {
        $query = Pet::where('status', 'available'); 
    
        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Type filter
        if ($request->type) {
            $query->where('type', $request->type);
        }
        
        // Size filter
        if ($request->size) {
            $query->where('size', $request->size);
        }
        
        // Gender filter
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }
        
        $pets = $query->paginate(8);
        
        return view('pets.browse', compact('pets'));
    }
}