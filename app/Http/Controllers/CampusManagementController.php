<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $searchFilter = $request->search;
        
        $campus = Campus::query();

        if ($searchFilter) {
            $campus->where(function($query) use ($searchFilter) {
                $query->where('campus_name', 'like', "%{$searchFilter}%")
                    ->orWhere('location', 'like', "%{$searchFilter}%");
            });
        }
        
        $campuses = $campus->orderBy('campus_name', 'asc')->paginate(10);

        return view('admin.campus-management', compact('campuses'));
    }

    public function edit($id)
    {
        $campus = Campus::findOrFail($id);

        return view('admin.campus-edit', compact('campus'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'campus_id' => 'required',
            'campus_name' => 'required|string|max:255',
            'location' => 'required|string',
        ]);

        $campus = Campus::findOrFail($request->input('campus_id'),);

        $campus->update([
            'campus_name' => $request->input('campus_name'),
            'location' => $request->input('location'),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.campus_management')->with('success', 'Campus Updated successfully.');
    }
    
    public function destroy(Request $request)
    {
        $request->validate([
            'campus_id' => ['required'],
        ]);

        $campus = Campus::findOrFail($request->campus_id);
        $campus->delete();
        
        return redirect()->route('admin.campus_management')->with(
            'success', 'Campus deleted successfully.',
        );
    }
    public function store(Request $request)
{
    $request->validate([
        'campus_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
    ]);

    Campus::create([
        'campus_name' => $request->input('campus_name'),
        'location' => $request->input('location'),
    ]);

    return redirect()->route('admin.campus_management')->with('success', 'Campus added successfully.');
}
}
