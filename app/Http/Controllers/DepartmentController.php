<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\models\Campus;
class DepartmentController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();
    $searchFilter = $request->search;
    $campuses = Campus::all();
    $departments = Department::query();

    if ($searchFilter) {
        $departments->where(function ($query) use ($searchFilter) {
            $query->where('college_name', 'like', "%{$searchFilter}%");
        });
    }

    $departments = $departments->orderBy('department_name', 'asc')->paginate(10);

    return view('admin.department', compact('departments', 'campuses'));
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

    return redirect()->route('admin.department')->with('success', 'Department added successfully.');
    }
    public function destroy(request $request)
    {
        $request->validate([
            'department_id' => ['required'],
        ]);

        $department = Department::findOrFail($request->department_id);
        $department->delete();
        
        return redirect()->route('admin.department')->with(
            'success', 'Department deleted successfully.',
        );
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
           
            'department_name' => 'required|string|max:255',
            'campus_id' => 'required',
            
        ]);

        $department = Department::findOrFail($request->input('id'),);

        $department->update([
            'department_name' => $request->input('department_name'),
            'campus_id' => $request->input('campus_id'),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.department')->with('success', 'Department Updated successfully.');
    }
}
