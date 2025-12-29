<?php
// app/Http/Controllers/AdoptionController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Http\Request;


class AdoptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show adoption form
    public function create(Pet $pet)
    {
        if (!$pet->isAvailable()) {
            return redirect()->route('home')->with('error', 'This pet is not available');
        }

        // Check if user already applied
        $existing = Adoption::where('user_id', auth()->id())
                           ->where('pet_id', $pet->id)
                           ->whereIn('status', ['pending', 'approved'])
                           ->exists();

        if ($existing) {
            return redirect()->route('home')->with('error', 'You already have a pending/approved request for this pet');
        }

        return view('adopt', compact('pet'));
    }

    // Submit adoption request
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'reason' => 'required|string|min:50|max:1000',
            'experience' => 'nullable|string|max:1000',
        ]);

        $pet = Pet::findOrFail($request->pet_id);

        if (!$pet->isAvailable()) {
            return back()->with('error', 'This pet is not available');
        }

        Adoption::create([
            'user_id' => auth()->id(),
            'pet_id' => $request->pet_id,
            'reason' => $request->reason,
            'experience' => $request->experience,
            'status' => 'pending',
        ]);

        return redirect()->route('my-adoptions')->with('success', 'Adoption request submitted successfully!');
    }

    // My adoptions
    public function myAdoptions()
    {
        $adoptions = Adoption::with('pet')
                            ->where('user_id', auth()->id())
                            ->latest()
                            ->get();

        return view('my-adoptions', compact('adoptions'));
    }
}
