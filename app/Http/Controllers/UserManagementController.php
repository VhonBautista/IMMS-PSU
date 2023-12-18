<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\UniversityRole;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        // Auth User : Always add this
        $user = $request->user();

        // Filters
        $searchFilter = $request->search;
        $universityRoleFilter = $request->university_role;
        $campusFilter = $request->campus;

        $universityRoles = UniversityRole::all();
        $campuses = Campus::all();
        $users = User::whereNotIn('id', [1]);

        if ($searchFilter) {
            $users->where(function($query) use ($searchFilter) {
                $query->where('firstname', 'like', "%{$searchFilter}%")
                    ->orWhere('lastname', 'like', "%{$searchFilter}%")
                    ->orWhere('email', 'like', "%{$searchFilter}%");
            });
        }

        if ($universityRoleFilter) {
            $users->where('univ_role_id', $universityRoleFilter);
        }

        if ($campusFilter) {
            $users->where('campus_id', $campusFilter);
        }

        $users = $users->orderBy('lastname', 'asc')->paginate(10);

        return view('admin.user-management', compact('user', 'users', 'universityRoles', 'campuses'));
    }
}
