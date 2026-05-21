<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'veterinario') {
        return redirect()->route('vet.dashboard');
    } else {
        return redirect()->route('recep.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Veterinario Routes (Admin can also access)
Route::middleware(['auth', 'role:admin,veterinario'])->prefix('vet')->group(function () {
    Route::get('/dashboard', function () {
        return view('vet.dashboard');
    })->name('vet.dashboard');
});

// Recepcionista Routes (Admin can also access)
Route::middleware(['auth', 'role:admin,recepcionista'])->prefix('recep')->group(function () {
    Route::get('/dashboard', function () {
        return view('recep.dashboard');
    })->name('recep.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
