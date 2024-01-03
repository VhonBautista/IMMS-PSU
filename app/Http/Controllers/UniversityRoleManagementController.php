<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UniversityRole;

class UniversityRoleManagementController extends Controller
{
   public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        
        $university = UniversityRole::query();

        if ($searchFilter) {
            $university->where(function($query) use ($searchFilter) {
                $query->where('university_role', 'like', "%{$searchFilter}%")
                    ->orWhere('description', 'like', "%{$searchFilter}%");
            });
        }
        
        $university_roles = $university->orderBy('university_role', 'asc')->paginate(10);

        return view('admin.university-role-management', compact('university_roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university_role' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        UniversityRole::create([
            'university_role' => $request->input('university_role'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.university_role_management')->with('success', 'University role added successfully.');
    }

    public function edit($id)
    {
        $university = UniversityRole::findOrFail($id);

        return view('admin.university-role-edit', compact('university'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'university_role' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $university = UniversityRole::findOrFail($request->input('id'),);

        $university->update([
            'university_role' => $request->input('university_role'),
            'description' => $request->input('description'),
        ]);

        if($university) {
            return redirect()->route('admin.university_role_management.edit', $request->input('id'))->with('success', 'University role information has been updated successfully.');
        } else {
            abort(500, 'Oops, something went wrong');
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        $university = UniversityRole::findOrFail($request->id);
        $university->delete();
        
        return redirect()->route('admin.university_role_management')->with('success', 'University role deleted successfully.');
    }
}
