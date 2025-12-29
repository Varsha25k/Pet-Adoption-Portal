<?php
// app/Http/Controllers/Admin/PetController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // List all pets
    public function index()
    {
        $pets = Pet::latest()->paginate(15);
        return view('admin.pets.index', compact('pets'));
    }

    // Show create form
    public function create()
    {
        return view('admin.pets.create');
    }

    // Store new pet
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:dog,cat,bird,rabbit,other',
            'breed' => 'required|string|max:100',
            'age' => 'required|integer|min:0|max:30',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large',
            'description' => 'required|string|min:20|max:2000',
            'location' => 'required|string|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vaccinated' => 'boolean',
            'trained' => 'boolean',
        ]);

        $data = $request->all();
        $data['vaccinated'] = $request->boolean('vaccinated');
        $data['trained'] = $request->boolean('trained');
        $data['status'] = 'available'; // Set default status

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        Pet::create($data);

        return redirect()->route('admin.pets.index')->with('success', 'Pet added successfully!');
    }

    // Show edit form
    public function edit(Pet $pet)
    {
        return view('admin.pets.edit', compact('pet'));
    }

    // Update pet
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:dog,cat,bird,rabbit,other',
            'breed' => 'required|string|max:100',
            'age' => 'required|integer|min:0|max:30',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large',
            'description' => 'required|string|min:20|max:2000',
            'location' => 'required|string|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:available,adopted',
            'vaccinated' => 'boolean',
            'trained' => 'boolean',
        ]);

        $data = $request->all();
        $data['vaccinated'] = $request->boolean('vaccinated');
        $data['trained'] = $request->boolean('trained');

        if ($request->hasFile('image')) {
            if ($pet->image) {
                Storage::disk('public')->delete($pet->image);
            }
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        $pet->update($data);

        return redirect()->route('admin.pets.index')->with('success', 'Pet updated successfully!');
    }

    // Delete pet
    public function destroy(Pet $pet)
    {
        // Check if pet has any adoptions
        if ($pet->adoptions()->exists()) {
            return redirect()->route('admin.pets.index')
                           ->with('error', 'Cannot delete pet with existing adoption records!');
        }

        DB::transaction(function () use ($pet) {
            if ($pet->image) {
                Storage::disk('public')->delete($pet->image);
            }
            
            $pet->delete();
        });
        
        return redirect()->route('admin.pets.index')->with('success', 'Pet deleted successfully!');
    }
}