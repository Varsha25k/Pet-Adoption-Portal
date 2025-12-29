<?php
// app/Http/Controllers/Admin/AdoptionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // List all adoption requests
    public function index()
    {
        $adoptions = Adoption::with(['user', 'pet'])
                            ->latest()
                            ->paginate(20);

        return view('admin.adoptions.index', compact('adoptions'));
    }

    // Show adoption details
    public function show(Adoption $adoption)
    {
        return view('admin.adoptions.show', compact('adoption'));
    }

    // Update adoption status
    public function updateStatus(Request $request, Adoption $adoption)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $adoption->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'approved_at' => $request->status === 'approved' ? now() : null,
        ]);

        // Update pet status if approved
        if ($request->status === 'approved') {
            $adoption->pet->update(['status' => 'adopted']);
        }

        return redirect()->route('admin.adoptions.index')
                        ->with('success', 'Adoption status updated!');
    }
}