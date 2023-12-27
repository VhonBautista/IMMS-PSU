<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Role;
use App\Models\UniversityRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
        $roles = Role::all();
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

        return view('admin.user-management', compact('user', 'users', 'universityRoles', 'campuses', 'roles'));
    }

    public function createAccount(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required'],
            'university_role' => ['required'],
            'campus' => ['required'],
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'univ_role_id' => $request->university_role,
            'campus_id' => $request->campus,
        ]);

        if($user) {
            $role = Role::find($request->role);
            $capitalizedRole = ucfirst($role->role_name);

            return redirect()->back()->with(
                'success', 'A new ' . $capitalizedRole . ' was added successfully.',
            );
        } else {
            abort(500, 'Oops, something went wrong');
        }
    }

    
    public function manage($id, Request $request)
    {
        $user = User::findOrFail($id);

        $universityRoles = UniversityRole::all();
        $campuses = Campus::all();
        $roles = Role::all();
        
        if($user) {
            return view('admin.user-manage', compact('user', 'universityRoles', 'campuses', 'roles'));
        } else {
            abort(500, 'Oops, something went wrong');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'role' => ['required'],
            'university_role' => ['required'],
            'campus' => ['required'],
        ]);

        $user = User::findOrFail($request->user_id);

        $user->update([
            'role_id' => $request->role,
            'univ_role_id' => $request->university_role,
            'campus_id' => $request->campus,
        ]);

        if($user) {
            return redirect()->back()->with(
                'success', 'Account information for this account has been updated successfully.',
            );
        } else {
            abort(500, 'Oops, something went wrong');
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
        ]);

        $user = User::findOrFail($request->user_id);

        // Delete associated data (e.g., posts)
        // $user->posts()->delete();

        $user->delete();

        return redirect()->route('admin.user_management')->with(
            'success', 'Account deleted successfully.',
        );
    }
}
