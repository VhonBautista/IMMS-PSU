<?php

use App\Http\Controllers\CampusManagementController;
use App\Http\Controllers\CollegeManagementController;
use App\Http\Controllers\CourseCollegeManagementController;
use App\Http\Controllers\UniversityRoleManagementController;
use App\Http\Controllers\DepartmentManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CourseManagementController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MatrixManagementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubmissionController;
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
            case 4:
                return redirect()->route('home');
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
    Route::patch('user-management/manage', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('user-management/delete/', [UserManagementController::class, 'destroy'])->name('user.destroy');

    // Course Management
    Route::get('course-management/', [CourseManagementController::class, 'index'])->name('admin.course_management');
    Route::post('course-management/', [CourseManagementController::class, 'store'])->name('admin.course_management.store');
    Route::get('course-management/edit/{id}', [CourseManagementController::class, 'edit'])->name('admin.course_management.edit');
    Route::patch('course-management/edit/', [CourseManagementController::class, 'update'])->name('admin.course_management.update');
    Route::delete('course-management/delete/', [CourseManagementController::class, 'destroy'])->name('admin.course_management.destroy');

    // Campus Management
    Route::get('campus-management/', [CampusManagementController::class, 'index'])->name('admin.campus_management');
    Route::post('campus-management/', [CampusManagementController::class, 'store'])->name('admin.campus_management.store');
    Route::get('campus-management/edit/{id}', [CampusManagementController::class, 'edit'])->name('admin.campus_management.edit');
    Route::patch('campus-management/edit/', [CampusManagementController::class, 'update'])->name('admin.campus_management.update');
    Route::delete('campus-management/delete/', [CampusManagementController::class, 'destroy'])->name('admin.campus_management.destroy');

    // College Management
    Route::get('college-management/', [CollegeManagementController::class, 'index'])->name('admin.college_management');
    Route::post('college-management/', [CollegeManagementController::class, 'store'])->name('admin.college_management.store');
    Route::get('college-management/edit/{id}', [CollegeManagementController::class, 'edit'])->name('admin.college_management.edit');
    Route::patch('college-management/edit/', [CollegeManagementController::class, 'update'])->name('admin.college_management.update');
    Route::delete('college-management/delete/', [CollegeManagementController::class, 'destroy'])->name('admin.college_management.destroy');

    // Department Management
    Route::get('department-management/', [DepartmentManagementController::class, 'index'])->name('admin.department_management');
    Route::post('department-management/', [DepartmentManagementController::class, 'store'])->name('admin.department_management.store');
    Route::get('department-management/edit/{id}', [DepartmentManagementController::class, 'edit'])->name('admin.department_management.edit');
    Route::patch('department-management/edit/', [DepartmentManagementController::class, 'update'])->name('admin.department_management.update');
    Route::delete('department-management/delete/', [DepartmentManagementController::class, 'destroy'])->name('admin.department_management.destroy');
    
    // Univeristy Role Management
    Route::get('university-role-management/', [UniversityRoleManagementController::class, 'index'])->name('admin.university_role_management');
    Route::post('university-role-management/', [UniversityRoleManagementController::class, 'store'])->name('admin.university_role_management.store');
    Route::get('university-role-management/edit/{id}', [UniversityRoleManagementController::class, 'edit'])->name('admin.university_role_management.edit');
    Route::patch('university-role-management/edit/', [UniversityRoleManagementController::class, 'update'])->name('admin.university_role_management.update');
    Route::delete('university-role-management/delete/', [UniversityRoleManagementController::class, 'destroy'])->name('admin.university_role_management.destroy');

    // Course Colleges Management
    Route::get('course-college-management/', [CourseCollegeManagementController::class, 'index'])->name('admin.course_college_management');
    Route::get('get-courses-for-college/{collegeId}', [CourseCollegeManagementController::class, 'getCoursesForCollege']);
    Route::post('course-college-management/', [CourseCollegeManagementController::class, 'store'])->name('admin.course_college_management.store');
    Route::get('course-college-management/remove/{collegeId}/{courseId}', [CourseCollegeManagementController::class, 'remove'])->name('admin.course_college_management.remove');

    // Matrix Management
    Route::get('matrix-management/', [MatrixManagementController::class, 'index'])->name('admin.matrix_management');
    Route::get('get-university-roles-for-matrix/', [MatrixManagementController::class, 'getUniversityRolesForMatrix']);
    Route::post('matrix-management/', [MatrixManagementController::class, 'store'])->name('admin.matrix_management.store');
    Route::get('matrix-management/manage/{matrixId}', [MatrixManagementController::class, 'manage'])->name('admin.matrix_management.manage');
    Route::patch('matrix-management/update/', [MatrixManagementController::class, 'update'])->name('admin.matrix_management.update');
    Route::delete('matrix-management/delete/', [MatrixManagementController::class, 'destroy'])->name('admin.matrix_management.destroy');
    Route::post('matrix-management/title', [MatrixManagementController::class, 'storeTitle'])->name('admin.matrix_management.title.store');
    Route::delete('matrix-management/title/delete/', [MatrixManagementController::class, 'destroyTitle'])->name('admin.matrix_management.title.destroy');
    Route::post('matrix-management/item', [MatrixManagementController::class, 'storeItem'])->name('admin.matrix_management.item.store');
    Route::get('matrix-management/item/remove/{matrixItemId}/{matrixId}', [MatrixManagementController::class, 'removeItem'])->name('admin.matrix_management.item.remove');
    Route::post('matrix-management/evaluator', [MatrixManagementController::class, 'storeEvaluator'])->name('admin.matrix_management.evaluator.store');
    Route::get('matrix-management/remove/{evaluatorId}/{matrixId}', [MatrixManagementController::class, 'remove'])->name('admin.matrix_management.remove');

    // Utilities
    Route::get('system-log/', [LogController::class, 'index'])->name('admin.system_log');
    Route::get('/notification', [NotificationController::class, 'index'])->name('admin.notification');
    Route::post('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
    Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');

});

// ========================== Evaluator Routes ========================== //
Route::middleware('auth', 'role:3')->group(function () {
    
});

// ========================== All User Routes ========================== //
Route::middleware('auth')->group(function () {
    Route::get('/instructional-materials', function () {
        return view('home');
    })->name('home');

    // Submission Management
    Route::get('submission-management/', [SubmissionController::class, 'index'])->name('submission_management');
    Route::get('submission-management/{materialId}', [SubmissionController::class, 'view'])->name('submission_management.view');
    Route::post('submission-management/store', [SubmissionController::class, 'store'])->name('submission.store');
    //filter campus
    Route::get('/get-courses/{campusId}', [SubmissionController::class, 'getCourses']);
    Route::get('/get-departments/{campusId}', [SubmissionController::class, 'getDepartments']);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
