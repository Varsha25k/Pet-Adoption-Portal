<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdoptionProcessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\AdoptionController as AdminAdoptionController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/browse-pets', [HomeController::class, 'browse'])->name('pets.browse'); 
Route::get('/pet/{pet}', [HomeController::class, 'show'])->name('pet.show');
Route::get('/adoption-process', [AdoptionProcessController::class, 'index'])->name('adoption-process');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User Routes (Protected)
Route::middleware('auth')->group(function () {
    // Adoption Routes
    Route::get('/adopt/{pet}', [AdoptionController::class, 'create'])->name('adopt.create');
    Route::post('/adopt', [AdoptionController::class, 'store'])->name('adopt.store');
    Route::get('/my-adoptions', [AdoptionController::class, 'myAdoptions'])->name('my-adoptions');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePassword'])->name('profile.change-password');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password.update');
});

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Pets Management
    Route::resource('pets', AdminPetController::class);
    
    // Adoptions Management
    Route::get('/adoptions', [AdminAdoptionController::class, 'index'])->name('adoptions.index');
    Route::get('/adoptions/{adoption}', [AdminAdoptionController::class, 'show'])->name('adoptions.show');
    Route::put('/adoptions/{adoption}/status', [AdminAdoptionController::class, 'updateStatus'])->name('adoptions.updatestatus');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/adoptions', [AdminController::class, 'userAdoptions'])->name('users.adoptions');
});

