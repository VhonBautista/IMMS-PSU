<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusesManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $searchFilter = $request->search;
        $campus = Campus::query();

        if ($searchFilter) {
            $campus->where(function($query) use ($searchFilter) {
                $query->where('campus_name', 'like', "%{$searchFilter}%")
                    ->orWhere('location', 'like', "%{$searchFilter}%")
                    ->orWhere('created_at', 'like', "%{$searchFilter}%")
                    ->orWhere('updated_at', 'like', "%{$searchFilter}%");
            });
        }
        $campuses = $campus->orderBy('campus_name', 'asc')->paginate(10);
        return view('admin.campuses-management', compact('campuses'));
    }
    public function destroy($id)
    {
        $campus = Campus::findOrFail($id);
        $campus->delete();

        return redirect()->route('admin.campuses-management')->with('success', 'Campus deleted successfully!');
    }
    public function edit($id)
    {
        $campus = Campus::findOrFail($id);

        // Pass the $campus data to the edit view
        return view('admin.edit-campus', compact('campus'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'campus_name' => 'required|string',
            'location' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        $campus = Campus::findOrFail($id);

        $campus->update([
            'campus_name' => $request->input('campus_name'),
            'location' => $request->input('location'),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.campuses-management');
    }
}
