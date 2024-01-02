<?php

namespace App\Http\Controllers;
use App\Models\Campus;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollegeManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        $campusFilter = $request->campus;

        $campuses = Campus::all();
        $colleges = College::query();

        if ($searchFilter) {
            $colleges->where(function ($query) use ($searchFilter) {
                $query->where('college_name', 'like', "%{$searchFilter}%");
            });
        }

        if ($campusFilter) {
            $colleges->where('campus_id', $campusFilter);
        }

        $colleges = $colleges->orderBy('college_name', 'asc')->paginate(10);

        return view('admin.college-management', compact('colleges','campuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'college_name' => 'required|string|max:255',
            'campus_id' => 'required|exists:campuses,id',
            'description' => 'nullable',
        ]);

        College::create([
            'college_name' => $request->input('college_name'),
            'campus_id' => $request->input('campus_id'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.college_management')->with('success', 'College added successfully.');
    }

    public function edit($id)
    {
        $college = College::findOrFail($id);
        $campuses = Campus::all();

        return view('admin.college-edit', compact('college', 'campuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'college_name' => 'required',
            'campus_id' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $college = College::findOrFail($request->input('college_id'),);

        $college->update([
            'college_name' => $request->input('college_name'),
            'description' => $request->input('description'),
            'campus_id' => $request->input('campus_id')
        ]);

        return redirect()->route('admin.college_management.edit', $request->input('college_id'))->with('success', 'College updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'college_id' => ['required'],
        ]);

        $college = College::findOrFail($request->input('college_id'));
        $college->delete();
        
        return redirect()->route('admin.college_management')->with(
            'success', 'College deleted successfully.'
        );
    }
}
