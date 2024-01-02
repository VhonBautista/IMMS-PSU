<?php

use App\Http\Controllers\CampusManagementController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseCollegeManagementController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UniversityRolesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseManagementController;
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
    Route::get('user-management/', [UserManagementController::class, 'index'])->name('admin.user_management');
    Route::post('user-management/', [UserManagementController::class, 'createAccount'])->name('user.create_account');
    Route::get('user-management/manage/{id}', [UserManagementController::class, 'manage'])->name('user.manage');
    Route::patch('user-management/manage/', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('user-management/delete/', [UserManagementController::class, 'destroy'])->name('user.destroy');

    // Course Management
    Route::get('course-management', [CourseManagementController::class, 'index'])->name('admin.course_management');
    Route::post('course-management', [CourseManagementController::class, 'store'])->name('admin.course_management.store');
    Route::get('course-management/edit/{id}', [CourseManagementController::class, 'edit'])->name('admin.course_management.edit');
    Route::patch('course-management/edit/', [CourseManagementController::class, 'update'])->name('admin.course_management.update');
    Route::delete('course-management/delete/', [CourseManagementController::class, 'destroy'])->name('admin.course_management.destroy');

    // Campus Management
    Route::get('campus-management/', [CampusManagementController::class, 'index'])->name('admin.campus_management');
    Route::post('campus-management/', [CampusManagementController::class, 'store'])->name('admin.campus_management.store');
    Route::get('campus-management/edit/{id}', [CampusManagementController::class, 'edit'])->name('admin.campus_management.edit');
    Route::patch('campus-management/edit', [CampusManagementController::class, 'update'])->name('admin.campus_management.update');
    Route::delete('campus-management/delete/', [CampusManagementController::class, 'destroy'])->name('admin.campus_management.destroy');
    
    //course colleges
    Route::get('course-college-management', [CourseCollegeManagementController::class, 'index'])->name('admin.course_college_management');
    Route::get('get-courses-for-college/{collegeId}', [CourseCollegeManagementController::class, 'getCoursesForCollege']);
    Route::post('course-college-management', [CourseCollegeManagementController::class, 'store'])->name('admin.course_college_management.store');
    Route::get('course-college-management/remove/{collegeId}/{courseId}', [CourseCollegeManagementController::class, 'remove'])->name('admin.course_college_management.remove');

    //colleges
    Route::get('/college', [CollegeController::class, 'index'])->name('admin.college');
    Route::post('/college', [CollegeController::class, 'store'])->name('college.store');
    Route::delete('college/delete/{id}', [CollegeController::class, 'destroy'])->name('college.destroy');
    Route::get('college/{id}/edit/', [CollegeController::class, 'edit'])->name('college.edit');
    Route::patch('college/edit/', [CollegeController::class, 'update'])->name('college.update');

    //department
    Route::get('/department', [DepartmentController::class, 'index'])->name('admin.department');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::delete('department/delete/', [DepartmentController::class, 'destroy'])->name('department.destroy');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::patch('department/edit/', [DepartmentController::class, 'update'])->name('department.update');

     // Univeristy Roles
    Route::get('university-role-management', [UniversityRolesController::class, 'index'])->name('admin.university_roles_management');
    Route::post('university-role-management', [UniversityRolesController::class, 'store'])->name('admin.university_roles_management.store');
    Route::get('university-role-management/edit/{id}', [UniversityRolesController::class, 'edit'])->name('admin.university_roles_management.edit');
    Route::patch('university-role-management/edit/', [UniversityRolesController::class, 'update'])->name('admin.university_roles_management.update');
    Route::delete('university-role-management/delete/', [UniversityRolesController::class, 'destroy'])->name('admin.university_roles_management.destroy');
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
