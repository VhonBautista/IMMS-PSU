<?php

use App\Http\Controllers\CampusManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseManagementController;
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
    Route::get('user-management/', [UserManagementController::class, 'index'])->name('admin.user_management');
    Route::post('user-management/', [UserManagementController::class, 'createAccount'])->name('user.create_account');
    Route::get('user-management/manage/{id}', [UserManagementController::class, 'manage'])->name('user.manage');
    Route::patch('user-management/manage/', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('user-management/delete/', [UserManagementController::class, 'destroy'])->name('user.destroy');

    // Course Management
    Route::get('course-management', [CourseManagementController::class, 'index'])->name('admin.course_management');
    Route::post('course-management', [CourseManagementController::class, 'store'])->name('admin.course-management.store');
    Route::get('course-management/edit/{id}', [CourseManagementController::class, 'edit'])->name('admin.course-management.edit');
    Route::patch('course-management/edit/', [CourseManagementController::class, 'update'])->name('admin.course-management.update');
    Route::delete('course-management/', [CourseManagementController::class, 'destroy'])->name('admin.course-management.destroy');

    // Campus Management
    Route::get('/admin/campuses-management', [CampusManagementController::class, 'index'])->name('admin.campuses-management');
    Route::get('campuses/', [CampusManagementController::class, 'index'])->name('campuses_management');
    Route::get('/campuses/{id}', [CampusManagementController::class, 'destroy'])->name('campus.delete');
    Route::get('/admin/campuses-management/{id}/edit', [CampusManagementController::class, 'edit'])->name('admin.campuses-management.edit');
    Route::put('/admin/campuses-management/{id}', [CampusManagementController::class, 'update'])->name('admin.campuses-management.update');
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
