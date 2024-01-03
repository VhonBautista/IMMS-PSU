<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Campus;
class DepartmentManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $user = $request->user();
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $campuses = Campus::all();
        $departments = Department::query();

        if ($searchFilter) {
            $departments->where(function ($query) use ($searchFilter) {
                $query->where('department_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($campusFilter) {
            $departments->where('campus_id', $campusFilter);
        }

        $departments = $departments->orderBy('department_name', 'asc')->paginate(10);

        return view('admin.department-management', compact('departments', 'campuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        Department::create([
            'department_name' => $request->input('department_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        return redirect()->route('admin.department_management')->with('success', 'Department added successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $campuses = Campus::all();

        return view('admin.department-edit', compact('department','campuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required',
        ]);

        $department = Department::findOrFail($request->input('department_id'));

        $department->update([
            'department_name' => $request->input('department_name'),
            'campus_id' => $request->input('campus_id'),
        ]);

        return redirect()->route('admin.department_management.edit', $request->input('department_id'))->with('success', 'Department updated successfully.');
    }

    public function destroy(request $request)
    {
        $request->validate([
            'department_id' => ['required'],
        ]);

        $department = Department::findOrFail($request->department_id);
        $department->delete();
        
        return redirect()->route('admin.department_management')->with(
            'success', 'Department deleted successfully.',
        );
    }
}
