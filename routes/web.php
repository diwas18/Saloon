<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

// Public Routes (Accessible to everyone)
Route::get('/', [PagesController::class, 'welcome'])->name('welcome');
Route::get('serviceview/{id}', [PagesController::class, 'serviceview'])->name('serviceview');
Route::get('expert/{id}', [PagesController::class, 'expertview'])->name('expertview');
Route::get('work/{id}', [PagesController::class, 'workview'])->name('workview');
Route::get('branch/{id}', [PagesController::class, 'branchview'])->name('branchview');

// Admin Dashboard (Only accessible to admins)
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['admin']) // Only 'admin' middleware to prevent auto-login redirect
    ->name('dashboard');

// Admin-restricted routes
Route::middleware(['admin'])->group(function () {
    Route::resource('experts', ExpertController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('works', WorkController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('bookings', BookingController::class);

    // User Management (Only for Admins)
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

// Booking Routes (Accessible to everyone, no authentication required)
Route::get('/book-now', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/book-now', [BookingController::class, 'store'])->name('bookings.store');

// Profile routes (Only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__.'/auth.php';
