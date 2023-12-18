<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// =============================== Index =============================== //
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        switch ($user->role_id) {
            case 1:
            case 2:
                return redirect()->route('admin.dashboard');
                break;
            case 3:
                // return redirect()->route('evaluator.evaluation');
                break;
            case 4:
                // return redirect()->route('home');
                break;
            default:
                abort(404, 'Page not found');
        }
    } else {
        return redirect()->route('login');
    }
});

// ====================== Admin & Moderator Routes ====================== //
Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User Management
    Route::get('user/', [UserManagementController::class, 'index'])->name('user_management');
});

// ========================== Evaluator Routes ========================== //
Route::middleware('auth', 'role:3')->group(function () {
    // Route::get('/evaluations', function () {
    //     return view('evaluator.evaluation');
    // })->name('evaluator.evaluation');
});

// ======================== Regular User Routes ======================== //
Route::middleware('auth', 'role:4')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

// ========================== All User Routes ========================== //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
