<?php

use App\Http\Controllers\CampusesManagementController;
use App\Http\Controllers\courseCollegesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseController;
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


    // Course Management
    Route::get('/admin/course-management', [CourseController::class, 'index'])->name('admin.course_management');
    Route::post('admin/course-management', [CourseController::class, 'store'])->name('admin.course-management.store');
    Route::get('/admin/course-management/{id}/edit', [CourseController::class, 'edit'])->name('admin.course-management.edit');
    Route::put('/admin/course-management/{id}', [CourseController::class, 'update'])->name('admin.course-management.update');
    Route::delete('/admin/course-management/{id}', [CourseController::class, 'destroy'])->name('admin.course-management.destroy');

    //campuses
    Route::get('/admin/campuses-management', [CampusesManagementController::class, 'index'])->name('admin.campuses-management');
    Route::get('campuses/', [CampusesManagementController::class, 'index'])->name('campuses_management');
    Route::get('/campuses/{id}', [CampusesManagementController::class, 'destroy'])->name('campus.delete');
    Route::get('/admin/campuses-management/{id}/edit', [CampusesManagementController::class, 'edit'])->name('admin.campuses-management.edit');
    Route::put('/admin/campuses-management/{id}', [CampusesManagementController::class, 'update'])->name('admin.campuses-management.update');
    //course colleges
    Route::get('/admin/courseColleges', [courseCollegesController::class, 'index'])->name('admin.courseColleges');
    Route::post('/course_colleges', [CourseCollegesController::class, 'store'])->name('course_colleges.store');
    Route::delete('/course_colleges/{id}', [CourseCollegesController::class, 'destroy'])->name('course_colleges.delete');
    Route::get('/admin/course_colleges/{id}/edit', [CourseCollegesController::class, 'edit'])->name('course_colleges.edit');
    Route::put('/admin/course_colleges/{id}', [CourseCollegesController::class, 'update'])->name('course_colleges.update');
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
