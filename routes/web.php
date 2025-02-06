<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('experts', ExpertController::class);

Route::resource('categories', CategoryController::class);

Route::resource('services', ServiceController::class);

Route::resource('works', WorkController::class);


Route:: resource('branches', BranchController::class);

Route:: resource('bookings', BookingController::class);





Route::get('/', [PagesController::class, 'welcome'])->name('welcome');
// Define the route for serviceview
Route::get('serviceview/{id}', [PagesController::class, 'serviceview'])->name('serviceview');

Route::get('expert/{id}', [PagesController::class, 'expertview'])->name('expertview');

Route::get('work/{id}', [PagesController::class, 'workview'])->name('workview');

//branchview
Route::get('branch/{id}', [PagesController::class, 'branchview'])->name('branchview');


// Show a list of all users
Route::get('/users', [UserController::class, 'index'])->name('user.index');

// Show a specific user
Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');

// Edit user details
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

// Delete a user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
