<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Adoption;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_pets' => Pet::count(),
            'available_pets' => Pet::where('status', 'available')->count(),
            'adopted_pets' => Pet::where('status', 'adopted')->count(),
            'pending_requests' => Adoption::where('status', 'pending')->count(),
            'approved_requests' => Adoption::where('status', 'approved')->count(),
            'total_users' => User::where('is_admin', false)->count(),
        ];

        $recent_requests = Adoption::with(['user', 'pet'])
                                   ->latest()
                                   ->take(5)
                                   ->get();

        return view('admin.dashboard', compact('stats', 'recent_requests'));
    }
    public function userAdoptions($id)
{
    $user = User::findOrFail($id);
    
    // Get all adoption requests by this user
    $adoptions = Adoption::where('user_id', $id)
                    ->with('pet')
                    ->orderBy('created_at', 'desc')
                    ->get();
    
    return view('admin.users.adoptions', compact('user', 'adoptions'));
}
}